<?php

namespace App\Http\Controllers\client;

use App\Http\Controllers\Controller;
use App\Models\User;
use Auth;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function showFormLogin()
    {
        return view('client.auth.log-reg.login');
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
    // đăng nhập, đăng ký với tài khoản google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::query()->where('google_id', $user->id)->first();
            if ($finduser) {
                Auth::login($finduser);
            } else {
                $newUser = User::query()->updateOrCreate(['email' => $user->email], [
                    'full_name' => $user->name,
                    'google_id' => $user->id,
                    'status_account' => 1,
                    'password' => $this->genPass(),
                ]);
                if ($newUser) {
                    Auth::login($newUser);
                } else {
                    return redirect()->back()->withErrors('error', 'Không thể đăng ký tài khoản, vui lòng kiểm tra lại!');
                }
            }
            return redirect()->intended('/');
        } catch (\Exception $e) {
            return redirect()->back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    public function logout()
    {
        Auth::logout();
        \request()->session()->invalidate();
        return redirect('/');
    }
    protected function genPass()
    {
        $password = Str::password(16);
        return encrypt($password);
    }
}
