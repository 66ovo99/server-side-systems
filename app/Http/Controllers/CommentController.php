<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store($id, Request $request)
    {
        // 验证评论内容
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        // 查找对应博客
        $blog = Blog::findOrFail($id);

        // 创建评论
        $blog->comments()->create([
            'user_id' => Auth::id(),
            'content' => $request->content,
        ]);

        // 成功创建评论后，重定向到该博客详情页
        return redirect()->route('blogs.show', ['id' => $id])->with('success', 'Review Submitted!');
    }

}
