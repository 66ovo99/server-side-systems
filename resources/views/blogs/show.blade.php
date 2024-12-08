@extends('layout.app')

@section('title', $blog->title)

@section('style')
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <style>
        body {
        background-color: #f0f4f8; /* 使用淡蓝色或浅灰色作为背景色 */
        }

        .comment-box {
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        
        .add-comment {
            border: 1px solid #e2e8f0;
            padding: 15px;
            background-color: #f7fafc;
            border-radius: 10px;
        }

        textarea {
            resize: none;
            font-size: 16px;
        }

        button {
            transition: background-color 0.3s ease;
        }
    </style>
@endsection


@section('content')
    <h1>{{ $blog->title }}</h1>
    <p>{{ $blog->content }}</p>
    <hr>

    <h2>Current Comments</h2>
    @if($comments->isEmpty())
        <p>no comments</p>
    @else
        @foreach($comments as $comment)
            <div class="comment-box p-4 mb-4 bg-gray-100 rounded-lg">
                <strong>{{ $comment->user->username }}:</strong>
                <p>{{ $comment->content }}</p>
            </div>
        @endforeach
    @endif

    @if(Auth::check())
        <div class="add-comment mt-6">
            <h3 class="mb-4 text-lg font-bold">Comment</h3>
            <form action="{{ route('blogs.comments.store', $blog->id) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="content" class="block text-sm font-bold mb-2">Add Comment：</label>
                    <textarea name="content" id="content" rows="3" class="w-full p-3 border border-gray-300 rounded-lg mb-4" placeholder="Write your comment..."></textarea>
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Submit a review</button>
            </form>
        </div>
    @else
        <p>Please <a href="{{ route('login') }}" class="text-blue-500 hover:underline">login</a> to comments</p>
    @endif
@endsection

