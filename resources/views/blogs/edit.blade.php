@extends('layout.app')

@section('title', 'edit')

@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    body {
        background-color: #f0f4f8; /* 使用淡蓝色或浅灰色作为背景色 */
        background: url('/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
    }
</style>
@endsection

@section('content')
<main class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="title" class="block text-sm font-bold mb-2">Blog Title：</label>
            <input type="text" id="title" name="title" value="{{ $blog->title }}" class="w-full p-2 border border-gray-300 rounded" placeholder="Please enter a blog title">
        </div>
        <div class="mb-4">
            <label for="content" class="block text-sm font-bold mb-2">Blog Content：</label>
            <textarea id="content" name="content" class="w-full p-2 border border-gray-300 rounded" rows="8" placeholder="Please enter the blog content">{{ $blog->content }}</textarea>
        </div>
        <div class="mb-4">
            <label for="file" class="block text-sm font-bold mb-2">Upload files (optional)：</label>
            <input type="file" id="file" name="file" class="w-full p-2 border border-gray-300 rounded">
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">Save changes</button>
        </div>
    </form>
</main>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
