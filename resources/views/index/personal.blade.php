@extends('layout.app')

@section('title', 'personal')

@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
<style>
    body {
        background: url('/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .button-group {
        display: flex;
        justify-content: space-around;
        align-items: center;
        margin-top: 20px;
    }

    .button-group button {
        flex: 1;
        max-width: 150px;
        margin: 0 10px;
    }

    .blog-card {
        border: 1px solid #e5e7eb;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        background-color: #ffffff;
    }

    .blog-actions {
        display: flex;
        justify-content: flex-end;
        gap: 10px;
    }

    .edit-button {
        background-color: #f59e0b;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
    }

    .delete-button {
        background-color: #ef4444;
        color: #ffffff;
        padding: 5px 10px;
        border-radius: 5px;
        text-decoration: none;
    }
</style>
@endsection

@section('content')
<div class="container mx-auto mt-13 p-6 bg-white shadow-md rounded-lg w-full">
    <p>This is the personal center page where you can view personal information and manage content.</p>

    <!-- 用户头像和用户名 -->
    <div class="user-info mb-6">
        <img src="{{ $user->avatar }}" alt="User Avatar" class="avatar rounded-full w-30 h-24">
        <h3>username：{{ $user->username }}</h3>
    </div>

    <!-- 更换用户名和更换头像按钮 -->
    <div class="button-group">
        <a href="{{ route('user.name.edit') }}" class="bg-blue-500 text-white px-4 py-2 rounded text-center">Change Username</a>
        <a href="{{ route('user.avatar') }}" class="bg-blue-500 text-white px-4 py-2 rounded text-center">Update your avatar</a>
    </div>

    <!-- 博客列表 -->
    <h2 class="mt-8">My blog list</h2>
    @if($blogs->isEmpty())
    <p>You currently have no blog created.</p>
    @else
    <ul>
        @foreach($blogs as $blog)
        <li class="blog-card">
            <h3>Title：{{ $blog->title }}</h3>
            <p>{{ Str::limit($blog->content, 150, '...') }}</p>
            <p>Posted on:{{ $blog->created_at->format('Y-m-d H:i') }}</p>
            @if($blog->file_path)
            <p>appendix:<a href="{{ asset('storage/' . $blog->file_path) }}" target="_blank">{{ basename($blog->file_path) }}</a></p>
            @endif
            <div class="blog-actions">
                <a href="{{ route('blogs.edit', $blog->id) }}" class="edit-button">edit</a>
                <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="delete-button">delete</button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
    @endif
</div>
@endsection
