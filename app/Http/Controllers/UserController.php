<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * 显示个人中心页面
     */
    public function showPersonalPage()
    {
        // 检查用户是否登录
        if (!Auth::check()) {
            // 用户未登录，重定向到登录页面
            return redirect()->route('login')->with('warning', 'Please log in before accessing the personal center.');
        }
        
        // 获取当前用户
        $user = Auth::user();

        // 获取当前用户的博客列表
        $blogs = Blog::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();

        // 返回个人中心页面视图，传递用户和博客列表数据
        return view('index.personal', compact('user', 'blogs'));
    }

    /**
     * 显示更换用户名页面
     */
    public function editUserName()
    {
        // 获取当前用户
        $user = Auth::user();

        // 返回更换用户名的视图
        return view('user.edit-username', compact('user'));
    }

    /**
     * 更新用户名
     */
    public function updateUserName(Request $request)
    {
        // 验证用户名
        $request->validate([
            'username' => 'required|string|max:255',
        ]);

        // 获取当前用户并更新用户名
        $user = Auth::user();
        $user->username = $request->username;
        $user->save();

        // 重定向回个人中心页面，并提示成功信息
        return redirect()->route('personal')->with('success', 'Username updated successfully!');
    }

    /**
     * 显示更新头像页面
     */
    public function avatarPage()
    {
        return view('user.avatar');
    }

    /**
     * 更新用户头像
     */
    public function avatarUpdate(Request $request)
    {
        // 验证上传文件
        $request->validate([
            'avatar' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // 获取当前用户
        $user = Auth::user();

        // 处理头像上传
        if ($request->hasFile('avatar')) {
            $avatarPath = $request->file('avatar')->store('avatars', 'public');
            $user->avatar = $avatarPath;
            $user->save();
        }

        // 重定向回个人中心页面，并提示成功信息
        return redirect()->route('personal')->with('success', 'Avatar updated successfully!');
    }
}
