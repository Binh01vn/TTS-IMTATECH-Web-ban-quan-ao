<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('client.main-contents.authentication.login');
    }
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return redirect()->back()->withErrors([
            'email' => 'Sai email tài khoản!',
            'password' => 'Sai mật khẩu!',
        ])->onlyInput('email');
    }
    public function logout()
    {
        Auth::logout();

        \request()->session()->invalidate();
        return redirect('/');
    }
}
