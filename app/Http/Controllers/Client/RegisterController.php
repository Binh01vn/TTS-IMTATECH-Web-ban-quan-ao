<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function showFormReg()
    {
        return view('client.auth.log-reg.register');
    }
    public function register(Request $request)
    {
        $request->validate([
            'full_name' => 'required|min:5|max:255',
            'phone_number' => ['required', 'regex:/^(0|\+84)[0-9]{9,10}$/'],
            'address' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed',
        ], [
            // Thông báo lỗi custom cho từng trường
            'full_name.required' => 'Họ và tên là bắt buộc.',
            'full_name.min' => 'Họ và tên phải có ít nhất 5 ký tự.',
            'full_name.max' => 'Họ và tên không được vượt quá 255 ký tự.',

            'phone_number.required' => 'Số điện thoại là bắt buộc.',
            'phone_number.regex' => 'Số điện thoại không đúng định dạng. Phải bắt đầu bằng 0 hoặc +84 và có 9-10 chữ số.',

            'address.required' => 'Địa chỉ là bắt buộc.',
            'address.max' => 'Địa chỉ không được vượt quá 255 ký tự.',

            'email.required' => 'Email là bắt buộc.',
            'email.email' => 'Email không hợp lệ.',
            'email.max' => 'Email không được vượt quá 255 ký tự.',

            'password.required' => 'Mật khẩu là bắt buộc.',
            'password.min' => 'Mật khẩu phải có ít nhất 8 ký tự.',
            'password.max' => 'Mật khẩu không được vượt quá 255 ký tự.',
            'password.confirmed' => 'Xác nhận mật khẩu không khớp.',
        ]);
        $user = User::query()->create([
            'full_name' => $request->name,
            'phone_number' => $request->phone_number,
            'address' => $request->address,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
