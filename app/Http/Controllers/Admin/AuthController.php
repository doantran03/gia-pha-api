<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function loginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate(
            [
                'email'    => ['required', 'email'],
                'password' => ['required', 'min:6'],
            ],
            [
                'email.required'    => 'Vui lòng nhập email',
                'email.email'       => 'Email không hợp lệ',
                'password.required' => 'Vui lòng nhập mật khẩu',
                'password.min'      => 'Mật khẩu tối thiểu 6 ký tự',
            ]
        );

        if (Auth::attempt($credentials, $request->boolean('remember'))) {
            $request->session()->regenerate();

            return redirect()->intended('/');
        }

        return back()
            ->withErrors([
                'login' => 'Email hoặc mật khẩu không chính xác',
            ])
            ->onlyInput('email');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}
