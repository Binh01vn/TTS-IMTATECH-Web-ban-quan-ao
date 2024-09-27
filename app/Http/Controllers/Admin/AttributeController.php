<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ColorAttribute;
use App\Models\SizeAttribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AttributeController extends Controller
{
    public function listAttribute()
    {
        $color = ColorAttribute::query()->get();
        $size = SizeAttribute::query()->get();
        return view('admin.contents.Attributes.index', compact('color', 'size'));
    }
    public function createAttrValues(Request $request)
    {
        $values = $request->values;
        if (!empty(array_filter($values, fn($value) => empty ($value)))) {
            return redirect()->back()->with(['error' => 'Một số giá trị thuộc tính trống, mời kiểm tra lại!']);
        }
        $attributeType = $request->sltAttribute;
        $tableMap = [
            'color' => ['table' => 'color_attributes', 'column' => 'colorValue'],
            'size' => ['table' => 'size_attributes', 'column' => 'sizeValue']
        ];
        if (!isset($tableMap[$attributeType])) {
            return redirect()->back()->with(['error' => 'Loại thuộc tính không hợp lệ!']);
        }
        $rules = [];
        foreach ($values as $key => $value) {
            $rules["values.$key"] = [
                Rule::unique($tableMap[$attributeType]['table'], $tableMap[$attributeType]['column'])
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator);
        }
        try {
            DB::beginTransaction();
            foreach ($values as $value) {
                DB::table($tableMap[$attributeType]['table'])->insert([$tableMap[$attributeType]['column'] => $value]);
            }
            DB::commit();
            return redirect()->back()->with(['success' => 'Thêm mới thuộc tính thành công!']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
    }

    public function delValueC(string $id)
    {
        $valueC = ColorAttribute::query()->findOrFail($id);
        if ($valueC->delete()) {
            return response()->json(['success' => 'Xóa giá trị thuộc tính thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function delValueS(string $id)
    {
        $valueS = SizeAttribute::query()->findOrFail($id);
        if ($valueS->delete()) {
            return response()->json(['success' => 'Xóa giá trị thuộc tính thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }
    public function showFormEdit(string $attr)
    {
        if ($attr == 'color') {
            $dataAttr = ColorAttribute::query()->get();
            $attrName = 'Color Attribute';
        } elseif ($attr == 'size') {
            $dataAttr = SizeAttribute::query()->get();
            $attrName = 'Size Attribute';
        }
        return view('admin.contents.Attributes.edit', compact('dataAttr', 'attrName'));
    }
    public function update(Request $request, string $attr)
    {
        $dataUpdate = $request->update;
        $dataValues = $request->values;
        $hasEmpty = fn($arr) => !empty (array_filter($arr, fn($val) => empty ($val)));
        if ($hasEmpty($dataUpdate) || ($dataValues && $hasEmpty($dataValues))) {
            return redirect()->back()->withErrors(['error' => 'Một số giá trị thuộc tính trống!']);
        }
        $tableMap = [
            'color' => ['table' => 'color_attributes', 'column' => 'colorValue'],
            'size' => ['table' => 'size_attributes', 'column' => 'sizeValue']
        ];
        if (!isset($tableMap[$attr])) {
            return redirect()->back()->with(['error' => 'Loại thuộc tính không hợp lệ!']);
        }
        if (count($dataUpdate) !== count(array_unique($dataUpdate))) {
            return redirect()->back()->withErrors(['error' => 'Có giá trị thuộc tính bị trùng lặp!']);
        }
        if ($dataValues) {
            $rules = [];
            foreach ($dataValues as $key => $value) {
                $rules["values.$key"] = [Rule::unique($tableMap[$attr]['table'], $tableMap[$attr]['column'])];
            }
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return redirect()->back()->withErrors($validator);
            }
        }
        try {
            DB::transaction(function () use ($dataUpdate, $dataValues, $tableMap, $attr) {
                foreach ($dataUpdate as $key => $value) {
                    DB::table($tableMap[$attr]['table'])->where('id', $key)->update([$tableMap[$attr]['column'] => $value]);
                }
                if ($dataValues) {
                    foreach ($dataValues as $value) {
                        DB::table($tableMap[$attr]['table'])->insert([$tableMap[$attr]['column'] => $value]);
                    }
                }
            });
            return redirect()->route('admin.attributes.list')->with(['success' => 'Cập nhật thuộc tính thành công!']);
        } catch (\Exception $exception) {
            return redirect()->back()->with(['error' => 'Có lỗi trong quá trình thực hiện!']);
        }
    }
}
