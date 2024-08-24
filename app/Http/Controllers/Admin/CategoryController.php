<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Str;
use Carbon\Carbon;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Category::query()->with(['parent', 'children'])->latest('id')->get();
        $categoryParent = Category::query()->with('children')->whereNull('parent_id')->get();
        return view('admin.contents.category.index', compact('data', 'categoryParent'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $request->validate(
            [
                'name' => 'required|min:2|max:255'
            ]
            ,
            [
                'name.required' => 'Không được để tên danh mục trống!',
                'name.max' => 'Tên danh mục không được vượt quá 255 ký tự!',
                'name.min' => 'Tên danh mục phải có độ dài lớn hơn 2 ký tự'
            ]
        );
        try {
            $validator['is_active'] = $request->is_active ??= 0;
            $validator['slug'] = '';
            $validator['slug'] = Str::slug($request->name);
            $validator['description'] = $request->description;
            if ($request->parent_id == null) {
                $validator['parent_id'] = 0;
            } else {
                $validator['parent_id'] = $request->parent_id;
            }
            Category::query()->create($validator);
            return redirect(route('admin.categories.listDM'));
        } catch (\Exception $exception) {
            
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $slug)
    {
        $data = Category::query()->where('slug', $slug)->firstOrFail();
        $categoryParent = Category::query()->with('children')->whereNull('parent_id')->get();
        return view('admin.contents.category.edit', compact('data', 'categoryParent'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $slug)
    {
        $validator = $request->validate(
            [
                'name' => 'required|min:2|max:255'
            ]
            ,
            [
                'name.required' => 'Không được để tên danh mục trống!',
                'name.max' => 'Tên danh mục không được vượt quá 255 ký tự!',
                'name.min' => 'Tên danh mục phải có độ dài lớn hơn 2 ký tự'
            ]
        );
        try {
            $validator['is_active'] = $request->is_active ??= 0;
            $validator['slug'] = '';
            $validator['slug'] = Str::slug($request->name);
            $validator['description'] = $request->description;
            $validator['updated_at'] = Carbon::now('Asia/Ho_Chi_Minh');
            if ($request->parent_id == null) {
                $validator['parent_id'] = 0;
            } else {
                $validator['parent_id'] = $request->parent_id;
            }
            $model = Category::query()->where('slug', $slug)->firstOrFail();
            $model->update($validator);
            return redirect(route('admin.categories.listDM'));
        } catch (\Exception $exception) {

        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $slug)
    {
        $model = Category::query()->where('slug', $slug)->firstOrFail();
        $model->delete();
        return back();
    }
}
