@extends('layout.app')

@section('title', 'edit-username')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
@endsection

@section('content')
<main class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-lg font-semibold mb-4">update username</h2>
    <form action="{{ route('user.info.update') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-4">
            <label for="username" class="block text-sm font-bold mb-2">username：</label>
            <input type="text" id="username" name="username" value="{{ old('username', Auth::user()->username) }}" class="w-full p-2 border border-gray-300 rounded" placeholder="请输入新的用户名">
        </div>
        <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">update username</button>
    </form>
</main>
@endsection
