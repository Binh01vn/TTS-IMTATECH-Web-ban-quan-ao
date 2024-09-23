<?php

namespace App\Http\Controllers\Auth\Client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function showFormReg()
    {
        return view('client.main-contents.authentication.register');
    }
    public function register(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|min:5|max:255',
            'phone_number' => 'required|phone:VN',
            'address' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'required|min:8|max:255|confirmed',
        ]);
        // dd($data);
        $user = User::query()->create($data);

        Auth::login($user);
        $request->session()->regenerate();
        return redirect()->intended('/');
    }
}
