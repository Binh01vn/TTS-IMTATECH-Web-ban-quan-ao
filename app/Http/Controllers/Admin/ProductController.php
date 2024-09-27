<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ColorAttribute;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\SizeAttribute;
use App\Models\Tag;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{
    public function list()
    {
        $dataProduct = Product::query()->where('is_active', 1)->with('tags')->paginate(7);
        return view('admin.contents.Product.list', compact('dataProduct'));
    }
    public function create()
    {
        $categoryParent = Category::query()->with('children')->whereNull('parent_id')->get();
        $dataTags = Tag::query()->get();
        $colorAttr = ColorAttribute::query()->get();
        $sizeAttr = SizeAttribute::query()->get();
        return view(
            'admin.contents.Product.create',
            compact('categoryParent', 'dataTags', 'colorAttr', 'sizeAttr')
        );
    }
    public function store(Request $request)
    {
        // dd($request->all());
        $productN = [];
        $productN['name'] = $request->name;
        $productN['slug'] = Str::slug($productN['name']);
        $productN['sku'] = $this->generateSKU($productN['slug']);
        $productN['image_thumbnail'] = $request->image_thumbnail ??= null;
        $productN['product_galleries'] = $request->product_galleries;
        $productN['price_default'] = $request->price_default ??= 0;
        $productN['price_sale'] = $request->price_sale ??= 0;
        $validator = validator(
            $productN,
            [
                'name' => 'required|max:255|min:5',
                'slug' => 'unique:products,slug',
                'image_thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'product_galleries.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'price_default' => 'required|numeric|min:0',
                'price_sale' => 'nullable|numeric|min:0|lt:price_default',
            ]
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $productN['sale_percent'] = $request->sale_percent ??= 0;
        if ($productN['price_sale'] >= 100) {
            return redirect()->back()->with(['error' => 'Giá cả nhập không hợp lý!.']);
        }
        $productN['start_date'] = $request->start_date ??= null;
        $productN['end_date'] = $request->end_date ??= null;
        if ($productN['start_date'] && $productN['end_date']) {
            $start = Carbon::parse($productN['start_date']);
            $end = Carbon::parse($productN['end_date']);
            if ($start->gt($end)) {
                return redirect()->back()->with(['error' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.']);
            }
        }
        $productN['is_active'] = $request->is_active ??= 0;
        $productN['quantity'] = $request->quantity ??= 0;
        $productN['description'] = $request->description ??= 'Chưa cập nhật mô tả cho sản phẩm!';
        $productN['material'] = $request->material ??= 'Thông tin chất liệu sản phẩm chưa được cập nhật!';
        $productN['user_manual'] = $request->user_manual ??= 'Chưa cập nhật hướng dẫn sử dụng cho sản phẩm!';
        $productN['category_id'] = $request->category_id ??= null;
        $productN['tags'] = $request->tags ??= null;
        $productV = $request->prdV;
        foreach ($productV as $idC => $value) {
            foreach ($value as $idS => $item) {
                $startDate = $item["'start_date'"] ??= null;
                $endDate = $item["'end_date'"] ??= null;
                if ($startDate && $endDate) {
                    $startDate = Carbon::parse($startDate);
                    $endDate = Carbon::parse($endDate);
                    if ($startDate->gt($endDate)) {
                        return redirect()->back()->with(['error' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.']);
                    }
                }
            }
        }
        try {
            DB::beginTransaction();
            /** @var Product $product */
            $slugCtr = Category::query()->where('id', $productN['category_id'])->first();
            if ($productN['image_thumbnail'] != null) {
                $productN['image_thumbnail'] = Storage::put("Products/ImgThumbnail/$slugCtr->slug", $productN['image_thumbnail']);
            }
            $product = Product::query()->create($productN);
            if ($productN['product_galleries'] != null) {
                foreach ($productN['product_galleries'] as $prdGallery) {
                    ProductGallery::query()->create(
                        [
                            'product_id' => $product->id,
                            'image' => Storage::put("Products/ImageGallerries/$slugCtr->slug/prd-$product->id", $prdGallery)
                        ]
                    );
                }
            }
            if ($productN['tags'] != null) {
                $product->tags()->sync($productN['tags']);
            }
            if ($productV) {
                foreach ($productV as $idColor => $v) {
                    foreach ($v as $idSize => $itemV) {
                        $prdVariants['product_id'] = $product->id;
                        $prdVariants['color_attribute_id'] = $idColor;
                        $prdVariants['size_attribute_id'] = $idSize;
                        $prdVariants['sku'] = $this->generateSKU($product->slug);
                        $prdVariants['price_dafault'] = $itemV["'price_dafault'"] ??= null;
                        $prdVariants['price_sale'] = $itemV["'price_sale'"] ??= null;
                        $prdVariants['start_date'] = $itemV["'start_date'"] ??= null;
                        $prdVariants['end_date'] = $itemV["'end_date'"] ??= null;
                        $prdVariants['quantity'] = $itemV["'quantity'"] ??= null;
                        ProductVariant::query()->create($prdVariants);
                    }
                }
            }
            DB::commit();
            return redirect()->route('admin.products.createPrd')->with('success', 'Thêm mới sản phẩm thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    // Hàm để tạo mã SKU duy nhất
    public function generateSKU($slug)
    {
        $sku = 'PRD' . strtoupper(Str::substr($slug, rand(0, strlen($slug)), rand(0, strlen($slug) - 5))) . '-' . strtoupper(Str::random(9));
        while (Product::query()->where('sku', $sku)->exists()) {
            $sku = 'PRD' . strtoupper(Str::substr($slug, rand(0, strlen($slug)), rand(0, strlen($slug) - 5))) . '-' . strtoupper(Str::random(9));
        }
        return $sku;
    }
    public function editProduct(string $slug)
    {
        $modelPrd = Product::query()->with(['tags', 'galleries', 'variants'])->where('slug', $slug)->first();
        $warningDate = '';
        if ($modelPrd->end_date) {
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            $nowDate = Carbon::parse($now);
            $endDate = Carbon::parse($modelPrd->end_date);
            if ($nowDate->gt($endDate)) {
                $warningDate = 'Thời gian khuyến mại sản phẩm kết thúc';
            }
            // $diffInDays = $nowDate->diffInDays($endDate, false); // Tính số ngày chênh lệch
            // if ($diffInDays > 5) {
            //     $soNgayThem = 3; // Số ngày muốn cộng thêm
            //     $modelPrd->end_date = $endDate->addDays($soNgayThem); // Cộng thêm số ngày quy định vào end_date nếu đã hết hạn quá 5 ngày
            //     $modelPrd->end_date = null; // Đặt end_date thành null nếu đã hết hạn quá 5 ngày
            // }
        }
        $categories = Category::query()->with('children')->whereNull('parent_id')->get();
        $dataTags = Tag::query()->get();
        $colorAttr = ColorAttribute::query()->get();
        $sizeAttr = SizeAttribute::query()->get();
        return view(
            'admin.contents.Product.edit',
            compact(
                'modelPrd',
                'categories',
                'dataTags',
                'warningDate',
                'colorAttr',
                'sizeAttr',
            )
        );
    }
    public function delImageG(string $id)
    {
        $image = ProductGallery::query()->findOrFail($id);
        if ($image->delete()) {
            Storage::delete($image->image);
            return response()->json(['success' => 'Xóa ảnh thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delTag(string $id)
    {
        $tags = DB::table('product_tag')->where('tag_id', $id);
        if ($tags->delete()) {
            return response()->json(['success' => 'Xóa tag thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function updateProduct(string $slug, Request $request)
    {
        $modelProduct = Product::query()->where('slug', $slug)->first();
        $productN = [];
        $checkSlug = true;
        $productN['name'] = $request->name;
        if ($modelProduct->slug == Str::slug($productN['name'])) {
            $checkSlug = false;
        } 
        $productN['product_galleries'] = $request->product_galleries ??= null;
        if ($productN['product_galleries'] != null) {
            $fileNames = [];
            foreach ($productN['product_galleries'] as $file) {
                $fileNames[] = $file->getClientOriginalName();
            }
            if (count($fileNames) !== count(array_unique($fileNames))) {
                return redirect()->back()->with(['product_galleries' => 'Các tệp trong thư viện sản phẩm phải là duy nhất.']);
            }
        }
        $productN['price_default'] = $request->price_default;
        $productN['price_sale'] = $request->price_sale;
        $validator = validator(
            $productN,
            [
                'name' => 'required|max:255|min:5',
                'product_galleries.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'price_default' => 'required|numeric|min:0',
                'price_sale' => 'nullable|numeric|min:0|lt:price_default',
            ]
        );
        $productN['tags'] = $request->tags ??= null;
        $validator->after(function ($validator) use ($request, $modelProduct, $checkSlug) {
            if ($checkSlug == true) {
                $exits2 = Product::query()->where('slug', Str::slug($request->name))->exists();
                if ($exits2) {
                    $validator->errors()->add('slug', 'Slug name sản phẩm bị trùng mời kiểm tra lại!');
                }
            }
            if ($request->tags != null) {
                $dataTags = $request->tags;
                foreach ($dataTags as $index => $value) {
                    $exits = DB::table('product_tag')->where([
                        'product_id' => $modelProduct->id,
                        'tag_id' => $value
                    ])->exists();
                    if ($exits) {
                        $validator->errors()->add("tags", "Sản phẩm đã được gắn thẻ tag với id $value!");
                    }
                }
            }
            if ($request->hasFile('image_thumbnail')) {
                $imageThumbnail = $request->file('image_thumbnail');
                $mimeTypes = ['jpeg', 'png', 'jpg', 'gif', 'svg', 'webp'];
                if (!in_array($imageThumbnail->getClientOriginalExtension(), $mimeTypes)) {
                    $validator->errors()->add('image_thumbnail', 'File upload phải là file ảnh và có các định dạng: jpeg, png, jpg, gif, svg, webp!');
                }
                if ($imageThumbnail->getSize() > 5120 * 1024) {
                    $validator->errors()->add('image_thumbnail', 'File ảnh không được vượt quá 5MB!');
                }
            }
        });
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $productN['sale_percent'] = $request->sale_percent;
        if ($productN['sale_percent'] >= 100) {
            return redirect()->back()->with(['error' => 'Giá cả nhập không hợp lý!.'])->withInput();
        }
        $productN['start_date'] = $request->start_date;
        $productN['end_date'] = $request->end_date;
        if ($productN['start_date'] && $productN['end_date']) {
            $start = Carbon::parse($productN['start_date']);
            $end = Carbon::parse($productN['end_date']);
            if ($start->gt($end)) {
                return redirect()->back()->with(['error' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.'])->withInput();
            }
        }
        $productN['description'] = $request->description ??= 'Chưa cập nhật mô tả cho sản phẩm!';
        $productN['material'] = $request->material ??= 'Thông tin chất liệu sản phẩm chưa được cập nhật!';
        $productN['user_manual'] = $request->user_manual ??= 'Chưa cập nhật hướng dẫn sử dụng cho sản phẩm!';
        if ($request->category_id == null || $request->category_id == 'nullSlt') {
            $productN['category_id'] = $modelProduct->category_id;
        } else {
            $productN['category_id'] = $request->category_id;
        }
        $productN['quantity'] = $request->quantity ??= 0;
        $productN['is_active'] = $request->is_active ??= 0;
        try {
            DB::beginTransaction();
            $tmpImgThumb = $modelProduct->image_thumbnail;
            $ctgr = Category::query()->where('id', $productN['category_id'])->firstOr();
            $slugCtg = $ctgr->slug;
            if ($request->hasFile('image_thumbnail')) {
                $productN['image_thumbnail'] = Storage::put("Products/ImgThumbnail/$slugCtg", $request->file('image_thumbnail'));
            }
            if ($checkSlug == true) {
                $productN['slug'] = Str::slug($productN['name']);
            }
            $modelProduct->update($productN);
            if ($productN['product_galleries'] != null) {
                foreach ($productN['product_galleries'] as $prdGallery) {
                    ProductGallery::query()->create(
                        [
                            'product_id' => $modelProduct->id,
                            'image' => Storage::put("Products/ImageGallerries/$slugCtg/prd-$modelProduct->id", $prdGallery)
                        ]
                    );
                }
            }
            if ($productN['tags'] != null) {
                foreach ($productN['tags'] as $idT) {
                    DB::table('product_tag')->insert([
                        'product_id' => $modelProduct->id,
                        'tag_id' => $idT,
                    ]);
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
