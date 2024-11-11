<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAttrValid extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'values' => 'nullable|array|min:1',
            'values.*' => 'required',
            'sltAttribute' => 'required|in:color,size',
        ];
    }
    public function messages()
    {
        return [
            'values.array' => 'Trường values phải là một mảng!',
            'values.min' => 'Trường values phải có ít nhất 1 giá trị!',
            'values.*.required' => 'Giá trị các thuộc tính không được rỗng!',
            'sltAttribute.required' => 'Vui lòng xác định thuộc tính (màu sắc hoặc kích thước)!',
            'sltAttribute.in' => 'Loại không hợp lệ, phải là "màu sắc" hoặc "kích thước"!',
        ];
    }
}
