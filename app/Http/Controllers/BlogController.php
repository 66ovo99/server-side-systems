<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class BlogController extends Controller
{  
    /**
     * 添加博客页面
     */
    public function create()
    {
        if (!auth()->check()) {
            // 用户未登录，返回登录页面并带上警告信息
            return redirect()->route('login')->with('warning', '请先登录后再发布博客。');
        }
    
        // 用户已登录，返回创建博客的页面
        return view('index.blog');
    }
    /**
     * 执行博客添加
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // 文件验证
        ]);

        //确保已经登录
        $user = Auth::user();
        
        // 处理文件上传
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('blog_files', 'public'); // 将文件存储在 'public/blog_files' 目录下
        }

        // 创建博客
        $user->blogs()->create([
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath, // 存储文件路径
        ]);

        return redirect()->route('index')->with('success', '博客发布成功！');
    }


    //发布成功回到发布页面
    public function index()
    {
        $blogs = Blog::orderBy('created_at', 'desc')->get(); // 按创建时间倒序排列获取所有博客
        return view('index.blog', compact('blogs'));
    }


    /**
     * 查看某个博客
     */
    public function show($id)
    {
        $blog = Blog::findOrFail($id); // 获取博客内容
        $comments = $blog->comments()->latest()->get(); // 获取与此博客关联的评论，按最新排序

        return view('blogs.show', compact('blog', 'comments'));
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }


    /**
     * 删除博客
     */
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        $filePath = $blog->file_path;
        if ($request->hasFile('file')) {
            $filePath = $request->file('file')->store('blog_files', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'file_path' => $filePath,
        ]);

        return redirect()->route('blogs.show', $id)->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('personal')->with('success', 'Blog deleted successfully!');
    }  
}

