<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Str;

class ProductController extends Controller
{
    public function listProduct()
    {
        return 'Day la trang list';
    }

    public function create()
    {
        $dataAttr = Attribute::query()->get();
        $categoryParent = Category::query()->with('children')->whereNull('parent_id')->get();
        $dataTags = Tag::query()->get();
        return view('admin.contents.Product.create', compact('dataAttr', 'categoryParent', 'dataTags'));
    }
    public function getAttrValue(Request $request)
    {
        $attributeId = $request->attribute_id;
        $attributeValues = AttributeValue::query()->where('attribute_id', $attributeId)->get();
        return response()->json($attributeValues);
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
        $messages = [
            'name.required' => 'Tên sản phẩm không được để trống!',
            'name.max' => 'Tên sản phẩm không dài hơn 255 ký tự!',
            'name.min' => 'Tên sản phẩm không ngắn hơn 5 ký tự!',
            'slug.unique' => 'Có lỗi trong quá trình tạo mã slug cho sản phẩm!',
            'sku.unique' => 'Có lỗi trong quá trình tạo mã sku cho sản phẩm!',
            'product_galleries.*.image' => 'File tải lên phải là file ảnh!',
            'product_galleries.*.mimes' => 'Ảnh chỉ được có định dạng: jpeg, png, jpg, gif, svg!',
            'product_galleries.*.max' => 'Mỗi ảnh không được lớn hơn 5MB!',
            'image_thumbnail.image' => 'File tải lên phải là file ảnh!',
            'image_thumbnail.mimes' => 'Ảnh chỉ được có định dạng: jpeg, png, jpg, gif, svg!',
            'image_thumbnail.max' => 'Mỗi ảnh không được lớn hơn 5MB!',
        ];
        $validator = validator(
            $productN,
            [
                'name' => 'required|max:255|min:5',
                'slug' => 'unique:products,slug',
                'sku' => 'unique:products,sku',
                'image_thumbnail' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
                'product_galleries.*' => 'image|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ],
            $messages
        );
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $productN['price_default'] = $request->price_default ??= 0;
        $productN['sale_percent'] = $request->sale_percent ??= 0;
        $productN['price_sale'] = $request->price_sale ??= 0;
        $productN['start_date'] = $request->start_date ??= null;
        $productN['end_date'] = $request->end_date ??= null;
        $productN['is_active'] = $request->is_active ??= 0;
        $productN['quantity'] = $request->quantity ??= 0;
        $productN['description'] = $request->description ??= 'Chưa cập nhật mô tả cho sản phẩm!';
        $productN['material'] = $request->material ??= 'Thông tin chất liệu sản phẩm chưa được cập nhật!';
        $productN['user_manual'] = $request->user_manual ??= 'Chưa cập nhật hướng dẫn sử dụng cho sản phẩm!';
        $productN['category_id'] = $request->category_id ??= null;
        $productN['tags'] = $request->tags ??= null;
        $productV = $request->prdV ??= null;
        // dd($productV);
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
            // if ($productV != null) {
            //     foreach ($productV as $parentKey => $childArray) {
            //         foreach ($childArray as $subKey => $subArray) {
            //             $priceDefault = $subArray["'price_dafault'"] ??= 0;
            //             $ps = $subArray["'price_sale'"] ??= 0;
            //             $sd = $subArray["'start_date'"] ??= null;
            //             $ed = $subArray["'end_date'"] ??= null;
            //             $quantity = $subArray["'quantity'"] ??= 0;

            //             // Xử lý giá trị
            //             echo "Key cha $parentKey, key con $subKey: price_default = $priceDefault, price_sale = $ps, start_date = $sd, end_date = $ed, quantity = $quantity" . "<br>";
            //         }
            //     }
            // }
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
        $sku = 'PRD' . '-' . strtoupper(Str::substr($slug, rand(0, strlen($slug)), rand(0, strlen($slug) - 5))) . '-' . strtoupper(Str::random(7));
        // Kiểm tra xem SKU có trùng lặp không
        while (Product::query()->where('sku', $sku)->exists()) {
            $sku = 'PRD' . '-' . strtoupper(Str::substr($slug, rand(0, strlen($slug)), rand(0, strlen($slug) - 5))) . '-' . strtoupper(Str::random(7));
        }
        return $sku;
    }
}
