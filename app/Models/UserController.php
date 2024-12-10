<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth; // 导入 Auth 类


class UserController extends Controller
{
    public function editUsername()
    {
        $user = Auth::user(); // 获取当前登录用户信息
        return view('user.edit-username', compact('user')); // 返回到编辑用户名的视图
    }

    // public function updateUserName(Request $request)
    // {
    //     $request->validate([
    //         'username' => 'required|string|max:255',
    //     ]);

    //     $user = Auth::user();
    //     $user->username = $request->username;
    //     $user->save();

    //     return redirect()->route('user.personal')->with('success', 'Username updated successfully!');
    // }


    public function avatarPage()
    {
        return view('user.avatar'); // 创建一个新的视图页面来显示头像更新表单
    }

    public function avatarUpdate(Request $request)
    {
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $user = Auth::user();

        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }

        return redirect()->route('personal')->with('success', 'Avatar updated successfully!');
    }

    public function showPersonalPage()
    {
        $user = Auth::user(); // 获取当前登录的用户
        $blogs = $user->blogs()->orderBy('created_at', 'desc')->get(); // 按创建时间倒序获取用户的博客

        return view('index.personal', compact('user', 'blogs')); // 将用户和博客列表传递到视图
    }

    public function infoUpdate(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        $user = Auth::user();
        $user->username = $request->input('username');
        $user->save();

        return redirect()->route('personal')->with('success', 'Username updated successfully!');
    }

}
