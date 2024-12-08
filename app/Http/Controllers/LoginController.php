<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // 验证输入的用户名和密码
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // 登录成功，重定向到个人中心页面
            return redirect()->route('personal');
        } else {
            // 登录失败，重定向回登录页面并显示错误信息
            return redirect()->route('login')->withErrors(['message' => 'Wrong email or password']);
        }
    }
}
