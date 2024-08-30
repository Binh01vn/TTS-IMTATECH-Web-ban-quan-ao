<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AttributeController extends Controller
{
    public function listAttributes()
    {
        $data = Attribute::query()->with('values')->get();
        return view('admin.contents.Attributes.index', compact('data'));
    }

    public function store(Request $request)
    {
        // dd($request->ids);
        if (empty($request->values)) {
            $validator1 = $request->validate(
                [
                    'name' => 'required|string|unique:attributes,name',
                ],
                [
                    'name.required' => 'Tên thuộc tính không để trống!',
                    'name.unique' => 'Tên thuộc tính đã tồn tại trong hệ thông!'
                ]
            );
            // dd($validator1); 
        } elseif (!empty($request->values)) {
            $dataValues = $request->values;
            $hasEmptyValue = false;
            foreach ($dataValues as $value) {
                if (empty($value)) {
                    $hasEmptyValue = true;
                    break;
                }
            }
            if ($hasEmptyValue) {
                // Trả lại dữ liệu và báo lỗi
                return redirect()->back()->withInput()->withErrors(['error' => 'Một số giá trị thuộc tính trống, mời kiểm tra lại!']);
            } else {
                $validator2 = $request->validate(
                    [
                        'name' => 'required|string|unique:attributes,name',
                        'values' => 'unique:attribute_values,value',
                    ],
                    [
                        'name.required' => 'Tên thuộc tính không để trống!',
                        'name.unique' => 'Tên thuộc tính đã tồn tại trong hệ thông!',
                        'values.unique' => 'Có giá trị thuộc tính đã tồn tại trong hệ thông!',
                    ]
                );
            }
        }
        try {
            DB::beginTransaction();

            if (isset($validator1)) {
                Attribute::query()->create($validator1);
            } elseif (isset($validator2)) {
                $attributeData = Attribute::query()->create([
                    'name' => $validator2['name']
                ]);
                foreach ($validator2['values'] as $values) {
                    AttributeValue::query()->create([
                        'attribute_id' => $attributeData->id,
                        'value' => $values
                    ]);
                }
            }
            DB::commit();
            return redirect()->route('admin.attributes.listAttr')->with('success', 'Thêm thuộc tính thành công!');
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
    public function destroy(string $id)
    {
        $model = Attribute::query()->findOrFail($id);
        $model->delete();
        $model->values()->delete();
        return redirect()->back()->with('success', 'Xóa thuộc tính thành công!');
    }
    public function edit(string $id)
    {
        $model = Attribute::query()->with('values')->findOrFail($id);
        return view('admin.contents.Attributes.edit', compact('model'));
    }
}
