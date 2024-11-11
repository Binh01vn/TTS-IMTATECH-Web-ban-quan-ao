<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductValid extends FormRequest
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
            // tên và mã sản phẩm
            'product-name' => ['required', 'min:5', 'max:255', 'unique:products,name'],
            'product-sku' => ['required', 'min:5', 'max:255', 'unique:products,sku'],
            // giá sản phẩm
            'price_default' => ['required', 'integer', 'min:1'],
            'sale_percent' => ['nullable', 'integer', 'min:1', 'max:99'],
            'price_sale' => ['nullable', 'integer', 'lt:price_default'],
            // ngày 
            'start_date' => ['nullable', 'date'],
            'end_date' => ['nullable', 'date', 'after_or_equal:start_date'],
            // số lượng
            'quantity' => ['nullable', 'integer', 'min:0'],
            // ảnh sản phẩm
            'product-galleries' => ['nullable', 'array'],
            'product-galleries.*' => ['image', 'max:5120', 'distinct'],
            'product-avatar' => ['required', 'image', 'max:5120'],
        ];
    }
    public function messages(): array
    {
        return [
            // name
            'product-name.required' => 'Tên sản phẩm không được để trống!',
            'product-name.min' => 'Tên sản phẩm không được ngắn hơn 5 ký tự!',
            'product-name.max' => 'Tên sản phẩm không được dài hơn 255 ký tự!',
            'product-name.unique' => 'Tên sản phẩm đã tồn tại trong hệ thống!',
            // sku
            'product-sku.required' => 'Mã sản phẩm không được để trống!',
            'product-sku.min' => 'Mã sản phẩm không được ngắn hơn 5 ký tự!',
            'product-sku.max' => 'Mã sản phẩm không được dài hơn 255 ký tự!',
            'product-sku.unique' => 'Mã sản phẩm đã tồn tại trong hệ thống!',
            // giá mặc định
            'price_default.required' => 'Giá mặc định là bắt buộc và phải lớn hơn 0!',
            'price_default.integer' => 'Giá mặc định phải là một số nguyên!',
            'price_default.min' => 'Giá mặc định phải lớn hơn 0!',
            // giá khuyến mại (cố định)
            'price_sale.integer' => 'Giá khuyến mãi phải là một số nguyên!',
            'price_sale.lt' => 'Giá khuyến mãi phải nhỏ hơn giá mặc định!',
            // giá khuyến mại (%)
            'sale_percent.integer' => 'Phần trăm giảm giá phải là một số nguyên!',
            'sale_percent.min' => 'Phần trăm giảm giá phải lớn hơn 0!',
            'sale_percent.max' => 'Phần trăm giảm giá phải nhỏ hơn 99!',
            // số lượng
            'quantity.integer' => 'Số lượng nhập vào phải là số nguyên!',
            'quantity.min' => 'Số lượng nhập vào phải là số nguyên dương!',
            // ngày
            'start_date.date' => 'Ngày bắt đầu phải là một ngày hợp lệ!',
            'end_date.date' => 'Ngày kết thúc phải là một ngày hợp lệ!',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu!',
            // thư viện ảnh của sản phẩm
            'product-galleries.*.image' => 'Mỗi tệp phải là một hình ảnh!',
            'product-galleries.*.max' => 'Dung lượng hình ảnh không được vượt quá 5MB!',
            'product-galleries.*.distinct' => 'Các hình ảnh không được trùng lặp!',
            // ảnh đại diện
            'product-avatar.required' => 'Sản phẩm phải có 1 ảnh đại diện!',
            'product-avatar.image' => 'File upload phải là file ảnh!',
            'product-avatar.max' => 'Dung lượng hình ảnh không được vượt quá 5MB!',
        ];
    }
}
