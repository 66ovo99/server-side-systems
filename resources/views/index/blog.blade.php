@extends('layout.app')

@section('title', 'create')

@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    body {
    background-color: #f0f4f8; /* 使用淡蓝色或浅灰色作为背景色 */
}
</style>
@endsection

@section('content')
<main class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    @if(Auth::check())
        <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label for="title" class="block text-sm font-bold mb-2">Blog title：</label>
                <input type="text" id="title" name="title" class="w-full p-2 border border-gray-300 rounded" placeholder="Please enter a blog title">
            </div>
            <div class="mb-4">
                <label for="content" class="block text-sm font-bold mb-2">Blog contents：</label>
                <textarea id="content" name="content" class="w-full p-2 border border-gray-300 rounded" rows="8" placeholder="Please enter the blog content"></textarea>
            </div>
            <div class="mb-4">
                <label for="file" class="block text-sm font-bold mb-2">upload file：</label>
                <input type="file" id="file" name="file" class="w-full p-2 border border-gray-300 rounded">
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">Publish blog</button>
            </div>
        </form>
    @else
        <!-- 用户未登录时显示警告按钮 -->
        <button onclick="showLoginAlert()" class="bg-blue-500 text-white px-4 py-2 rounded">Publish new blog</button>
        <script>
            function showLoginAlert() {
                alert('Please log in before posting');
                window.location.href = "{{ url('/login') }}"; // 重定向到登录页面
            }
        </script>
    @endif
</main>
@endsection

@section('script')
<script src="{{ asset('js/app.js') }}"></script>
@endsection
