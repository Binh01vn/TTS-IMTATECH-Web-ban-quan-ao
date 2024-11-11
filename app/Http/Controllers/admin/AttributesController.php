<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\AttributeValidation;
use App\Http\Requests\UpdateAttrValid;
use App\Models\ColorAttributes;
use App\Models\SizeAttributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributesController extends Controller
{
    public function list()
    {
        $colors = ColorAttributes::query()->get();
        $sizes = SizeAttributes::query()->get();
        return view('admin.attributes.list', compact('colors', 'sizes'));
    }
    public function store(AttributeValidation $request)
    {
        // Lấy dữ liệu đã được validate
        $validatedData = $request->validated();
        $values = $validatedData['values'];
        $type = $validatedData['sltAttribute'];
        // Kiểm tra các giá trị không trùng lặp trong mảng
        if (count($values) !== count(array_unique($values))) {
            return redirect()->back()
                ->withErrors(['values' => 'Các phần tử trong mảng không được phép trùng lặp!'])
                ->withInput();
        }
        // Kiểm tra trùng lặp trong cơ sở dữ liệu tùy theo loại (color hoặc size)
        if ($type === 'color') {
            $duplicates = DB::table('color_attributes')
                ->whereIn('value', $values)
                ->pluck('value')
                ->toArray();
        } else {
            $duplicates = DB::table('size_attributes')
                ->whereIn('value', $values)
                ->pluck('value')
                ->toArray();
        }
        // Nếu có trùng lặp, trả về thông báo lỗi
        if (!empty($duplicates)) {
            return redirect()->back()
                ->withErrors(['values' => 'Các giá trị sau đã tồn tại trong hệ thống: ' . implode(', ', $duplicates)])
                ->withInput();
        }
        $tableMap = [
            'color' => ['table' => 'color_attributes'],
            'size' => ['table' => 'size_attributes']
        ];
        try {
            DB::beginTransaction();
            foreach ($values as $value) {
                DB::table($tableMap[$type]['table'])->insert(['value' => $value]);
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'Thêm mới thuộc tính thành công!']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
    }
    public function edit(string $attr)
    {
        if ($attr == 'color') {
            $dataAttr = ColorAttributes::query()->get();
            $attrName = 'Màu sắc';
        }
        if ($attr == 'size') {
            $dataAttr = SizeAttributes::query()->get();
            $attrName = 'Kích thước';
        }
        return view('admin.attributes.edit', compact('dataAttr', 'attrName'));
    }
    public function update(UpdateAttrValid $request, string $attr)
    {
        // Lấy dữ liệu đã được validate
        $validatedData = $request->validated();
        $dataUpdate = $request->update;
        $type = $validatedData['sltAttribute'];
        $values = null;
        if (array_key_exists('values', $validatedData)) {
            $values = $validatedData['values'];
            // Kiểm tra các giá trị không trùng lặp trong mảng
            if (count($values) !== count(array_unique($values))) {
                return redirect()->back()
                    ->withErrors(['values' => 'Các phần tử trong mảng không được phép trùng lặp!'])
                    ->withInput();
            }
            // Kiểm tra trùng lặp trong cơ sở dữ liệu tùy theo loại (color hoặc size)
            if ($type === 'color') {
                $duplicates = DB::table('color_attributes')
                    ->whereIn('value', $values)
                    ->pluck('value')
                    ->toArray();
            } else {
                $duplicates = DB::table('size_attributes')
                    ->whereIn('value', $values)
                    ->pluck('value')
                    ->toArray();
            }
            // Nếu có trùng lặp, trả về thông báo lỗi
            if (!empty($duplicates)) {
                return redirect()->back()
                    ->withErrors(['values' => 'Các giá trị sau đã tồn tại trong hệ thống: ' . implode(', ', $duplicates)])
                    ->withInput();
            }
        }
        if (count($dataUpdate) !== count(array_unique($dataUpdate))) {
            return redirect()->back()->withErrors(['error' => 'Có giá trị thuộc tính bị trùng lặp!']);
        }
        $tableMap = [
            'color' => ['table' => 'color_attributes'],
            'size' => ['table' => 'size_attributes']
        ];
        try {
            DB::beginTransaction();
            foreach ($dataUpdate as $key => $value) {
                DB::table($tableMap[$attr]['table'])->where('id', $key)->update(['value' => $value]);
            }
            if ($values != null) {
                foreach ($values as $value) {
                    DB::table($tableMap[$type]['table'])->insert(['value' => $value]);
                }
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'Cập nhật thuộc tính thành công!']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
    }
    public function deleteColor(ColorAttributes $color)
    {
        if ($color->delete()) {
            return redirect()->back()->with('success', 'Xóa giá trị thuộc tính thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thuộc tính thất bại!');
        }
    }
    public function deleteSize(SizeAttributes $size)
    {
        if ($size->delete()) {
            return redirect()->back()->with('success', 'Xóa giá trị thuộc tính thành công!');
        } else {
            return redirect()->back()->with('error', 'Xóa thuộc tính thất bại!');
        }
    }
}
