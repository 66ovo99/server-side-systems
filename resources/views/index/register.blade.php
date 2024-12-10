@extends('layout.app')

@section('title', 'Register')

@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<style>
    body {
        background-color: #f0f4f8; /* 使用淡蓝色或浅灰色作为背景色 */
    }

    .form-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 70vh;
        flex-direction: column;
    }

    .form-card {
        width: 300px;
        padding: 20px;
        background-color: #ffffff;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }

    .form-card label {
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-card button {
        width: 100%;
    }
</style>
@endsection

@section('content')
<div class="form-container">
    <div class="form-card">
        <h3 class="text-center mb-4">Register to AntBlog</h3>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <div class="mb-4">
                <label for="username" class="block mb-2">username：</label>
                <input type="text" id="username" name="username" class="w-full p-2 border border-gray-300 rounded" placeholder="Please enter your username" required>
            </div>
            <div class="mb-4">
                <label for="email" class="block mb-2">email：</label>
                <input type="email" id="email" name="email" class="w-full p-2 border border-gray-300 rounded" placeholder="Please enter your email" required>
            </div>
            <div class="mb-4">
                <label for="password" class="block mb-2">password：</label>
                <input type="password" id="password" name="password" class="w-full p-2 border border-gray-300 rounded" placeholder="password > or = 6 digits" required>
            </div>
            <div class="mb-4">
                <label for="password_confirmation" class="block mb-2">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="w-full p-2 border border-gray-300 rounded" placeholder="Please enter your password again" required>
            </div>
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">register</button>
        </form>
    </div>
</div>
@endsection
