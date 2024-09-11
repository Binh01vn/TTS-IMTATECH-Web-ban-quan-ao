<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index()
    {
        $data = Tag::query()->latest('id')->get();
        return view('admin.contents.Tags.index', compact('data'));
    }
    public function create(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'required|unique:tags,name|string|min:2|max:50',
            ],
            [
                'name.required' => 'Không được để tên tag trống!',
                'name.unique' => 'Tag đã tồn tại trong hệ thông!',
                'name.string' => 'Dữ liệu nhập không hợp lệ!',
                'name.max' => 'Tên tag không được vượt quá 50 ký tự!',
                'name.min' => 'Tên tag phải có độ dài lớn hơn 2 ký tự'
            ]
        );
        // dd($validator);
        try {
            Tag::query()->create($validator);
            return redirect(route('admin.tags.listTags'))->with('success', 'Thêm mới tag thành công!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
    public function destroy(string $id)
    {
        $model = Tag::query()->findOrFail($id);
        $model->delete();
        return redirect()->back()->with('success', 'Xóa 1 tag thành công!');
    }
}
