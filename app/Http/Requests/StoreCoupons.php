<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCoupons extends FormRequest
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
            'name' => ['required', 'min:5', 'max:255'],
            'code' => ['required', 'min:5', 'max:255', 'unique:coupons,code'],
            'quantity' => ['required', 'integer', 'min:1'],
            'start_date' => ['required', 'date'],
            'end_date' => ['required', 'date', 'after_or_equal:start_date'],
            'discount_type' => ['required', 'in:percent,fixed'],
            'discount_amount' => ['required', 'min:1', 'numeric'],
            'minimum_spend' => ['required', 'min:1', 'numeric', 'lt:maximum_spend'],
            'maximum_spend' => ['required', 'min:1', 'numeric'],
        ];
    }
    public function messages()
    {
        return [
            // required
            'name.required' => 'Không được để trống tên mã khuyến mại!',
            'code.required' => 'Không được để trống mã khuyến mại!',
            'quantity.required' => 'Không được để trống số lượng!',
            'start_date.required' => 'Không được để trống ngày bắt đầu!',
            'end_date.required' => 'Không được để trống ngày kết thúc!',
            'discount_type.required' => 'Không được để trống kiểu giảm giá!',
            'discount_amount.required' => 'Không được để trống giá trị khuyến mại!',
            'minimum_spend.required' => 'Không được để trống chi tiêu tối thiểu!',
            'maximum_spend.required' => 'Không được để trống chi tiêu tối đa!',
            // numeric
            'discount_amount.numeric' => 'Trường dữ liệu phải là số!',
            'minimum_spend.numeric' => 'Trường dữ liệu phải là số!',
            'maximum_spend.numeric' => 'Trường dữ liệu phải là số!',
            // min
            'discount_amount.min' => 'Trường dữ liệu phải lớn hơn 0!',
            'minimum_spend.min' => 'Trường dữ liệu phải lớn hơn 0!',
            'maximum_spend.min' => 'Trường dữ liệu phải lớn hơn 0!',
            'quantity.min' => 'Trường dữ liệu phải lớn hơn 0!',
            'name.min' => 'Tên mã khuyến mại phải có độ dài lớn hơn 5 ký tự!',
            'code.min' => 'Mã khuyến mại phải có độ dài lớn hơn 5 ký tự!',
            // max
            'name.max' => 'Tên mã khuyến mại phải có độ dài nhỏ hơn 255 ký tự!',
            'code.max' => 'Mã khuyến mại phải có độ dài lớn nhỏ 255 ký tự!',
            // date
            'start_date.date' => 'Trường dữ liệu phải là ngày!',
            'end_date.date' => 'Trường dữ liệu phải là ngày!',
            'end_date.after_or_equal' => 'Ngày kết thúc phải sau hoặc bằng ngày bắt đầu!',
            // in:percent,fixed
            'discount_type.in' => 'Kiểu giảm giá không hợp lệ, phải là "Giảm giá phần trăm" hoặc "Giảm giá cố định"!',
            // unique:coupons,code
            'code.unique' => 'Mã giảm giá đã tồn tại trong hệ thống!',
            // integer
            'quantity.integer'=> 'Số lượng nhập vào phải là số nguyên dương!',
            // lt:maximum_spend
            'minimum_spend.lt' => 'Chi tiêu tối thiểu phải nhỏ hơn chi tiêu tối đa!',
        ];
    }
}
