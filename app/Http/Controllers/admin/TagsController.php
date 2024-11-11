<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Tags;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Str;

class TagsController extends Controller
{
    public function list()
    {
        $data = Tags::query()->orderBy('name', 'asc')->paginate(10);
        return view('admin.tags.list', compact('data'));
    }
    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required|unique:tags,name|max:50'],
            [
                'name.required' => 'Tên thẻ không được để trống!',
                'name.unique' => 'Tên thẻ đã tồn tại trong hệ thống!',
                'name.max' => 'Tên thẻ không được dài quá 50 ký tự!'
            ]
        );
        try {
            DB::beginTransaction();
            Tags::query()->create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
            DB::commit();
            return redirect()->route('admin.tags.list_tags')->with('success', 'Tạo mới 1 thẻ thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage())->withInput();
        }
    }
    public function delete(Tags $tag)
    {
        if ($tag->delete()) {
            return redirect()->route('admin.tags.list_tags')->with('success', 'Xóa 1 thẻ thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thẻ thất bại!');
        }
    }
}
