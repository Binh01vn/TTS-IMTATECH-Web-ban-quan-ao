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
        $validator = validator(
            $request->all(),
            [
                'name' => [
                    'required',
                    'min:5',
                    'max:50',
                    Rule::unique('attributes', 'name'),
                ],
            ],
            [
                'name.required' => 'Tên thuộc tính bị bỏ trống!',
                'name.unique' => "Tên thuộc tính '$request->name' đã tồn tại trong hệ thống!",
                'name.min' => "Tên thuộc tính quá ngắn!",
                'name.max' => "Tên thuộc tính quá dài!",
            ]
        );
        if (!empty($request->values)) {
            $dataValues = $request->values;
            $hasEmptyValue = false;
            foreach ($dataValues as $value) {
                if (empty($value)) {
                    $hasEmptyValue = true;
                    break;
                }
            }
            $validator->after(function ($validator) use ($request) {
                $dataValues = $request->values;
                foreach ($dataValues as $index => $value) {
                    $exists = AttributeValue::query()->where('value', $value)->exists();
                    if ($exists) {
                        $validator->errors()->add("values.$index", "Giá trị thuộc tính '$value' đã tồn tại trong hệ thống.");
                    }
                }
            });
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if (isset($hasEmptyValue) && $hasEmptyValue == true) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Một số giá trị thuộc tính trống, mời kiểm tra lại!']);
        }
        try {
            DB::beginTransaction();

            $attributeData = Attribute::query()->create([
                'name' => $request->name
            ]);
            if (isset($request->values)) {
                foreach ($request->values as $values) {
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

    public function delete(string $id)
    {
        $value = AttributeValue::query()->findOrFail($id);
        if ($value->delete()) {
            return response()->json(['success' => 'Xóa giá trị thuộc tính thành công!']);
        } else {
            return response()->json(['error' => 'Không thể kết nối đến server!'], 500);
        }
    }

    public function addOrCreate(Request $request, string $id)
    {
        $attributeData = Attribute::query()->findOrFail($id);
        $validator = validator(
            $request->all(),
            [
                'name' => [
                    'required',
                    'min:5',
                    'max:50',
                    Rule::unique('attributes', 'name')->ignore($attributeData->id),
                ],
            ],
            [
                'name.required' => 'Tên thuộc tính bị bỏ trống!',
                'name.unique' => "Tên thuộc tính '$request->name' đã tồn tại trong hệ thống!",
                'name.min' => "Tên thuộc tính quá ngắn!",
                'name.max' => "Tên thuộc tính quá dài!",
            ]
        );
        if (isset($request->update)) {
            $dataUpdate = $request->update;
            $hasEmptyUpdate = false;
            foreach ($dataUpdate as $update) {
                if (empty($update)) {
                    $hasEmptyUpdate = true;
                    break;
                }
            }
        }
        if (empty($request->values)) {
            $validator->after(function ($validator) use ($request) {
                $updates = $request->input('update', []);

                foreach ($updates as $attributeValueId => $value) {
                    $existingValue = AttributeValue::query()->where('value', $value)
                        ->where('id', '!=', $attributeValueId)
                        ->first();

                    if ($existingValue) {
                        $validator->errors()->add("update.$attributeValueId", "Giá trị thuộc tính '$value' đã tồn tại trong hệ thống.");
                    }
                }
            });
        }
        if (!empty($request->values)) {
            $dataValues = $request->values;
            $hasEmptyValue = false;
            foreach ($dataValues as $value) {
                if (empty($value)) {
                    $hasEmptyValue = true;
                    break;
                }
            }
            $validator->after(function ($validator) use ($request) {
                if (isset($request->update)) {
                    $updates = $request->update;
                    foreach ($updates as $attributeValueId => $value) {
                        $existingValue = AttributeValue::query()->where('value', $value)
                            ->where('id', '!=', $attributeValueId)
                            ->first();

                        if ($existingValue) {
                            $validator->errors()->add("update.$attributeValueId", "Giá trị thuộc tính '$value' đã tồn tại trong hệ thống.");
                        }
                    }
                }
                $dataValues = $request->values;
                foreach ($dataValues as $index => $value) {
                    $exists = AttributeValue::query()->where('value', $value)->exists();
                    if ($exists) {
                        $validator->errors()->add("update.$index", "Giá trị thuộc tính '$value' đã tồn tại trong hệ thống.");
                    }
                }
            });
        }
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        if ((isset($hasEmptyValue) && $hasEmptyValue == true) || (isset($hasEmptyUpdate) && $hasEmptyUpdate == true)) {
            return redirect()->back()->withInput()->withErrors(['error' => 'Một số giá trị thuộc tính trống, mời kiểm tra lại!']);
        }
        try {
            DB::beginTransaction();
            $attributeData->update(['name' => $request->name]);
            if (isset($request->update)) {
                foreach ($request->update as $valueID => $value) {
                    $valueData = AttributeValue::query()->findOrFail($valueID);
                    $valueData->update(['value' => $value]);
                }
            }
            if (isset($request->values)) {
                foreach ($request->values as $key => $value) {
                    AttributeValue::query()->create(['attribute_id' => $attributeData->id, 'value' => $value]);
                }
            }
            DB::commit();
            return redirect()->route('admin.attributes.listAttr')->with(['success' => 'Cập nhật thuộc tính thành công!']);
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
