<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Categorization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Str;

class CategoriesController extends Controller
{
    public function list()
    {
        $data = Categorization::query()->get();
        $data2 = Categories::query()->paginate(5);
        $categorization = Categorization::query()->get();
        return view('admin.categories.list', compact('data', 'data2', 'categorization'));
    }
    // ===========================================================================================
    public function phan_loai(Request $request)
    {
        // dd($request->all());
        $validator = $request->validate(
            [
                'name' => 'required|unique:categorizations,name|min:2|max:100|regex:/^[^<>]*$/',
                'description' => 'nullable|regex:/^[^<>]*$/',
            ],
            [
                'name.required' => 'Tên loại không được để trống!',
                'name.unique' => 'Tên loại đã tồn tại trong hệ thống!',
                'name.min' => 'Tên loại có độ dài ký tự tối thiểu 2 ký tự!',
                'name.max' => 'Tên loại có độ dài tối đa 100 ký tự!',
                'name.regex' => 'Không được nhập dữ liệu có định dạng HTML!',
            ]
        );
        try {
            DB::beginTransaction();
            Categorization::query()->create(
                [
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                    'description' => $request->description ??= 'Chưa cập nhật mô tả chi tiết!',
                ]
            );
            DB::commit();
            return redirect()->route('admin.categories.danh_sach')->with('success', 'Thêm mới 1 phân loại thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
    public function edit_pl(string $slug)
    {
        $data = Categorization::query()->where('slug', $slug)->firstOr();
        if ($data) {
            $url_update = route('admin.categories.update_pl', $data->slug);
            return response()->json(['data' => $data, 'url_update' => $url_update]);
        } else {
            return response()->json(['error' => 'Không tìm thấy dữ liệu bạn muốn chỉnh sửa!']);
        }
    }
    public function update_pl(Request $request, string $slug)
    {
        try {
            DB::beginTransaction();
            $data = Categorization::query()->where('slug', $slug)->firstOr();
            $data->update([
                'name' => $request->name,
                'slug'=> Str::slug($request->name),
                'description'=> $request->description ??= 'Chưa cập nhật mô tả chi tiết!',
            ]);
            DB::commit();
            return redirect()->route('admin.categories.danh_sach')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }
    // ========================================================================================================
    public function danh_muc(Request $request)
    {
        // dd($request->all());
        try {
            DB::beginTransaction();
            $category = Categories::query()->create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
                'description' => $request->description ??= 'Chưa cập nhật mô tả chi tiết!',
            ]);
            $category->categorizations()->sync($request->id_phan_loai);
            DB::commit();
            return redirect()->route('admin.categories.danh_sach')->with('success', 'Thêm mới 1 danh mục thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
    public function edit_dm(string $slug)
    {
        $data = Categories::query()->where('slug', $slug)->firstOr();
        if ($data) {
            $url_update = route('admin.categories.update_dm', $data->slug);
            return response()->json(['data' => $data, 'url_update' => $url_update]);
        } else {
            return response()->json(['error' => 'Không tìm thấy dữ liệu bạn muốn chỉnh sửa!']);
        }
    }
    public function update_dm(Request $request, string $slug)
    {
        try {
            DB::beginTransaction();
            $data = Categories::query()->where('slug', $slug)->firstOr();
            $data->update([
                'name' => $request->name,
                'slug'=> Str::slug($request->name),
                'description'=> $request->description ??= 'Chưa cập nhật mô tả chi tiết!',
            ]);
            DB::commit();
            return redirect()->route('admin.categories.danh_sach')->with('success', 'Cập nhật thông tin thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return back()->with('error', $exception->getMessage());
        }
    }
}
