<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth; // 导入 Auth 类
use Illuminate\Support\Facades\Session; // 导入 Session 类

class IndexController extends Controller
{
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get();//按照时间倒序生成
        return view('index.index', compact('blogs'));
    }

    public function personal()
    {
        if (Auth::check()) {
            $blogs = Auth::user()->blogs()->latest()->get(); // 获取当前用户的博客并按创建时间倒序排列
        } else {
            Session::flash('alert', 'Please log in first');
            return redirect()->route('login');
        }

        return view('index.personal', compact('blogs'));
    }
}
