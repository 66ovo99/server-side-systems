@extends('layout.app')

@section('title', 'change avatar')

@section('style')
<link rel="stylesheet" href="{{ asset('css/app.css')}}">
@endsection

@section('content')
<div class="container mx-auto my-10 p-6 bg-white rounded-lg shadow-md">
    <h2 class="text-2xl font-bold mb-4">Update avatar</h2>

    <form action="{{ route('user.avatar.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label for="avatar" class="block text-sm font-bold mb-2">choose new avatar：</label>
            <input type="file" id="avatar" name="avatar" class="w-full p-2 border border-gray-300 rounded">
        </div>

        <div class="flex justify-end">
            <button type="submit" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">update avatar</button>
        </div>
    </form>
</div>
@endsection
