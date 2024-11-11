<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categorization;
use App\Models\ProductGalleries;
use App\Models\ProductVariants;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Storage;

class AjaxController extends Controller
{
    public function rendCtg(string $id)
    {
        $categorization = Categorization::query()->findOrFail(intval($id));
        $categories = $categorization->categories()->get();
        return response()->json([
            'categories' => $categories,
        ]);
    }
    public function delTag(string $idTag, string $idPRD)
    {
        $tags = DB::table('product_tag')->where(['tags_id' => $idTag, 'products_id' => $idPRD]);
        if ($tags->delete()) {
            return response()->json(['success' => 'Xóa tag thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delImg(string $id)
    {
        $image = ProductGalleries::query()->findOrFail($id);
        if ($image->delete()) {
            Storage::delete($image->path_images);
            return response()->json(['success' => 'Xóa ảnh thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delVariant(string $id)
    {
        $variant = ProductVariants::query()->findOrFail($id);
        if ($variant->delete()) {
            return redirect()->back()->with('success', 'Xóa 1 biến thể sản phẩm thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa 1 biến thể sản phẩm thất bại!');
        }
    }
}
