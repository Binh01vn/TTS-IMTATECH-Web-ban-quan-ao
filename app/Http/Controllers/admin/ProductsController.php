<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProductValid;
use App\Http\Requests\UpdateProductValid;
use App\Models\Categories;
use App\Models\Categorization;
use App\Models\ColorAttributes;
use App\Models\ProductGalleries;
use App\Models\Products;
use App\Models\ProductVariants;
use App\Models\SizeAttributes;
use App\Models\Tags;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;
use Str;

class ProductsController extends Controller
{
    public function index()
    {
        $data = Products::query()->with(['tags'])->latest('id')->paginate(10);
        return view('admin.products.list-products', compact('data'));
    }
    public function trashed()
    {
        $data = Products::onlyTrashed()->with(['tags'])->latest('id')->paginate(10);
        return view('admin.products.trashed-products', compact('data'));
    }
    public function restoreAll()
    {
        Products::onlyTrashed()->restore();
        return redirect()->route('admin.products.list_sp')->with(['success' => 'Khôi phục tất cả sản phẩm đã xóa thành công!']);
    }
    public function forceDelProduct(string $id)
    {
        $product = Products::withTrashed()->find($id);
        if ($product) {
            $prd_galleries_tmp = $product->galleries()->pluck('path_images')->toArray();
            if ($product->forceDelete()) {
                Storage::delete($product->product_avatar);
                foreach ($prd_galleries_tmp as $img) {
                    Storage::delete($img);
                }
            }

            return redirect()->route('admin.products.list_trashed')->with(['success' => 'Xóa vĩnh viễn 1 sản phẩm thành công']);
        } else {
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
    }
    public function restoreProduct(string $id)
    {
        $product = Products::onlyTrashed()->find($id);

        if ($product) {
            $product->restore();
            return redirect()->route('admin.products.list_trashed')->with(['success' => 'Khôi phục sản phẩm thành công']);
        } else {
            return redirect()->back()->with(['error' => 'Sản phẩm không tồn tại hoặc chưa bị xóa mềm']);
        }
    }
    public function showForm()
    {
        $categorizations = Categorization::query()->get();
        $tags = Tags::query()->get();
        $colorAttr = ColorAttributes::query()->get();
        $sizeAttr = SizeAttributes::query()->get();
        return view('admin.products.add-product', compact('categorizations', 'tags', 'colorAttr', 'sizeAttr'));
    }
    public function store(StoreProductValid $request)
    {
        $prd_avatar = null;
        $prd_img_temp = [];
        $productV = $request['prdV'];
        if ($productV) {
            foreach ($productV as $idC => $value) {
                foreach ($value as $idS => $item) {
                    $startDate = $item["'start_date'"] ??= null;
                    $endDate = $item["'end_date'"] ??= null;
                    if ($startDate && $endDate) {
                        $startDate = Carbon::parse($startDate);
                        $endDate = Carbon::parse($endDate);
                        if ($startDate->gt($endDate)) {
                            return redirect()->back()->with(['prdVariant' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.'])->withInput();
                        }
                    }
                    $priceD = $item["'price_default'"] ??= null;
                    $priceS = $item["'price_sale'"] ??= null;
                    if ($priceD && $priceS && $priceS > $priceD) {
                        return redirect()->back()->with(['prdVariant' => 'Giá khuyến mại không được lớn hơn giá gốc.'])->withInput();
                    }
                }
            }
        } else {
            return redirect()->back()->with(['prdVariant' => 'Vui lòng xét thuộc tính cho sản phẩm!'])->withInput();
        }
        try {
            DB::beginTransaction();
            if ($request->hasFile('product-avatar')) {
                $prd_avatar = Storage::put("products/product-avatar", $request->file("product-avatar"));
            }
            $product = Products::query()->create(
                [
                    'categorization_id' => $request['product-pl'],
                    'categories_id' => $request['product-category'],
                    'name' => $request['product-name'],
                    'slug' => Str::slug($request['product-name']),
                    'sku' => $request['product-sku'],
                    'product_avatar' => $prd_avatar,
                    'price_default' => $request['price_default'],
                    'price_sale' => $request['price_sale'],
                    'discount_percent' => $request['sale_percent'],
                    'start_date' => $request['start_date'],
                    'end_date' => $request['end_date'],
                    'description' => $request['description'] ??= '<strong>Chưa cập nhật mô tả cho sản phẩm!</strong>',
                    'material' => $request['material'] ??= '<strong>Chưa cập nhật chất liệu sản phẩm!</strong>',
                    'user_manual' => $request['user_manual'] ??= '<strong>Chưa có hướng dẫn sử dụng cho sản phẩm!</strong>',
                    'quantity' => $request['quantity'] ??= 0,
                    'status' => $request['status'] ??= 1,
                ]
            );
            if ($request['product-tags'] && count($request['product-tags']) > 0) {
                $product->tags()->sync($request['product-tags']);
            }
            if ($request->hasFile('product-galleries')) {
                foreach ($request->file('product-galleries') as $key => $value) {
                    $product->galleries()->create(
                        [
                            'products_id' => $product->id,
                            'path_images' => $prd_img = Storage::put("products/galleries", $value),
                        ]
                    );
                    $prd_img_temp[$key] = $prd_img;
                }
            }
            if ($productV && count($productV) > 0) {
                foreach ($productV as $idColor => $v) {
                    foreach ($v as $idSize => $itemV) {
                        $product->variants()->create([
                            'products_id' => $product->id,
                            'color_attributes_id' => $idColor,
                            'size_attributes_id' => $idSize,
                            'price_default' => $itemV["'price_default'"],
                            'price_sale' => $itemV["'price_sale'"],
                            'start_date' => $itemV["'start_date'"],
                            'end_date' => $itemV["'end_date'"],
                            'quantity' => $itemV["'quantity'"],
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->back()->with('success', 'Tạo mới 1 sản phẩm thành công!');
        } catch (\Exception $exception) {
            if (isset($prd_avatar) && $prd_avatar != null) {
                Storage::delete($prd_avatar);
            }
            if (isset($prd_img_temp) && count($prd_img_temp) > 0) {
                foreach ($prd_img_temp as $img) {
                    Storage::delete($img);
                }
            }
            DB::rollBack();
            return redirect()->back()->with(['error' => $exception->getMessage()])->withInput();
        }
    }
    public function detail(string $slug)
    {
        $data = Products::query()->with(['tags', 'galleries', 'variants'])->where('slug', $slug)->first();
        if ($data == null) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm hợp lệ!');
        }
        return view('admin.products.detail-product', compact('data'));
    }
    public function edit(string $slug)
    {
        $data = Products::query()->with(['tags', 'galleries', 'variants', 'category'])->where('slug', $slug)->first();
        if ($data == null) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm hợp lệ!');
        }

        $warningDate = '';
        if ($data->end_date) {
            $now = Carbon::now('Asia/Ho_Chi_Minh')->format('Y-m-d H:i');
            $nowDate = Carbon::parse($now);
            $endDate = Carbon::parse($data->end_date);
            if ($nowDate->gt($endDate)) {
                $warningDate = 'Thời gian khuyến mại sản phẩm kết thúc';
            }
        }

        $categorizations = Categorization::query()->get();
        $categories = Categories::query()->get();
        $tags = Tags::query()->get();
        $colorAttr = ColorAttributes::query()->get();
        $sizeAttr = SizeAttributes::query()->get();
        return view(
            'admin.products.edit-product',
            compact(
                'data',
                'warningDate',
                'categorizations',
                'categories',
                'tags',
                'colorAttr',
                'sizeAttr'
            )
        );
    }
    public function update(UpdateProductValid $request, Products $product)
    {
        // dd($request->all(), $product);
        $prd_avatar = null;
        $prd_img_temp = [];
        $productV = $request['prdV'];
        if ($productV) {
            foreach ($productV as $idC => $value) {
                foreach ($value as $idS => $item) {
                    $startDate = $item["'start_date'"] ??= null;
                    $endDate = $item["'end_date'"] ??= null;
                    if ($startDate && $endDate) {
                        $startDate = Carbon::parse($startDate);
                        $endDate = Carbon::parse($endDate);
                        if ($startDate->gt($endDate)) {
                            return redirect()->back()->with(['prdVariant' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.'])->withInput();
                        }
                    }
                    $priceD = $item["'price_default'"] ??= null;
                    $priceS = $item["'price_sale'"] ??= null;
                    if ($priceD && $priceS && $priceS > $priceD) {
                        return redirect()->back()->with(['prdVariant' => 'Giá khuyến mại không được lớn hơn giá gốc.'])->withInput();
                    }
                }
            }
        }
        $updateVariants = $request['updateV'];
        if ($updateVariants) {
            foreach ($updateVariants as $itemV) {
                $startDate = $itemV["'start_date'"] ??= null;
                $endDate = $itemV["'end_date'"] ??= null;
                if ($startDate && $endDate) {
                    $startDate = Carbon::parse($startDate);
                    $endDate = Carbon::parse($endDate);
                    if ($startDate->gt($endDate)) {
                        return redirect()->back()->with(['prdVariant' => 'Ngày bắt đầu không được lớn hơn ngày kết thúc.']);
                    }
                }
                $priceD = $itemV["'price_default'"] ??= null;
                $priceS = $itemV["'price_sale'"] ??= null;
                if ($priceD && $priceS && $priceS > $priceD) {
                    return redirect()->back()->with(['prdVariant' => 'Giá khuyến mại không được lớn hơn giá gốc.'])->withInput();
                }
            }
        }
        try {
            DB::beginTransaction();
            $tmpImgThumb = $product->product_avatar;
            if ($request->hasFile('product-avatar')) {
                $prd_avatar = Storage::put("products/product-avatar", $request->file("product-avatar"));
            } else {
                $prd_avatar = $product->product_avatar;
            }
            $product->update([
                'categorization_id' => $request['product-pl'],
                'categories_id' => $request['product-category'] == null ? $product->categories_id : $request['product-category'],
                'name' => $request['product-name'],
                'slug' => Str::slug($request['product-name']),
                'product_avatar' => $prd_avatar,
                'price_default' => $request['price_default'],
                'price_sale' => $request['price_sale'],
                'discount_percent' => $request['sale_percent'],
                'start_date' => $request['start_date'],
                'end_date' => $request['end_date'],
                'description' => $request['description'] ??= '<strong>Chưa cập nhật mô tả cho sản phẩm!</strong>',
                'material' => $request['material'] ??= '<strong>Chưa cập nhật chất liệu sản phẩm!</strong>',
                'user_manual' => $request['user_manual'] ??= '<strong>Chưa có hướng dẫn sử dụng cho sản phẩm!</strong>',
                'quantity' => $request['quantity'] ??= 0,
                'status' => $request['status'] ??= 0,
            ]);
            if ($request['product-tags'] && count($request['product-tags']) > 0) {
                foreach ($request['product-tags'] as $idT) {
                    DB::table('product_tag')->insert([
                        'products_id' => $product->id,
                        'tags_id' => $idT,
                    ]);
                }
            }
            if ($request->hasFile('product-galleries')) {
                foreach ($request->file('product-galleries') as $key => $value) {
                    $product->galleries()->create(
                        [
                            'products_id' => $product->id,
                            'path_images' => $prd_img = Storage::put("products/galleries", $value),
                        ]
                    );
                    $prd_img_temp[$key] = $prd_img;
                }
            }
            if ($productV && count($productV) > 0) {
                foreach ($productV as $idColor => $v) {
                    foreach ($v as $idSize => $itemV) {
                        $product->variants()->create([
                            'products_id' => $product->id,
                            'color_attributes_id' => $idColor,
                            'size_attributes_id' => $idSize,
                            'price_default' => $itemV["'price_default'"],
                            'price_sale' => $itemV["'price_sale'"],
                            'start_date' => $itemV["'start_date'"],
                            'end_date' => $itemV["'end_date'"],
                            'quantity' => $itemV["'quantity'"],
                        ]);
                    }
                }
            }
            if ($updateVariants) {
                foreach ($updateVariants as $key => $value) {
                    $modelVariant = ProductVariants::query()->find($key);
                    $modelVariant->update(
                        [
                            'price_default' => $value["'price_default'"],
                            'price_sale' => $value["'price_sale'"],
                            'start_date' => $value["'start_date'"],
                            'end_date' => $value["'end_date'"],
                            'quantity' => $value["'quantity'"],
                        ]
                    );
                }
            }
            DB::commit();
            if ($request->hasFile('product-avatar') && $tmpImgThumb && Storage::exists($tmpImgThumb)) {
                Storage::delete($tmpImgThumb);
            }
            return redirect()->route('admin.products.list_sp')->with('success', 'Cập nhật sản phẩm thành công!');
        } catch (\Exception $exception) {
            if (isset($prd_avatar) && $prd_avatar != null) {
                Storage::delete($prd_avatar);
            }
            if (isset($prd_img_temp) && count($prd_img_temp) > 0) {
                foreach ($prd_img_temp as $img) {
                    Storage::delete($img);
                }
            }
            DB::rollBack();
            return redirect()->back()->with(['error' => $exception->getMessage()])->withInput();
        }
    }
    public function destroy(Products $product)
    {
        if ($product->delete()) {
            return redirect()->back()->with(['success' => 'Xóa mềm sản phẩm thành công!']);
        } else {
            return redirect()->back()->with(['error' => 'Xóa sản phẩm thất bại']);
        }
    }
}
