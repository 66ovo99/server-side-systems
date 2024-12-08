@extends('layout.app')

@section('title', 'homepage')

@section('style')
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
    body {
        background: url('/images/background.jpg') no-repeat center center fixed;
        background-size: cover;
    }

    .homepage-header {
        text-align: center;
        margin-top: 20px;
        margin-bottom: 30px;
    }

    .homepage-content {
        max-width: 800px;
        margin: 0 auto;
    }

    .blog-card {
        border: 1px solid #e5e7eb;
        padding: 15px;
        border-radius: 8px;
        margin-bottom: 15px;
        background-color: #ffffff;
    }

    .attachment-link {
        display: inline-block;
        margin-top: 10px;
        background-color: #2563eb;
        color: white;
        padding: 8px 12px;
        border-radius: 4px;
        text-decoration: none;
    }

    .attachment-link:hover {
        background-color: #1e40af;
    }
  </style>
@endsection

@section('content')
  <div class="homepage-content">
      <div class="homepage-header">
          <h1>Welcome to AntBlog</h1>
          <p>Here you can read and share wonderful articles.</p>
      </div>

      <!-- 最新博客展示 -->
      <h2>Latest Blog</h2>
      @if($blogs->isEmpty())
          <p>There is no blog content yet.</p>
      @else
          <ul>
              @foreach($blogs as $blog)
                  <li class="blog-card">
                      <h3><a href="{{ route('blogs.show', $blog->id) }}" class="text-blue-600 hover:underline">title:{{ $blog->title }}</a></h3>
                      <p>{{ Str::limit($blog->content, 150, '...') }}</p>
                      <p>author:{{ $blog->user->username }} | Posted on:{{ $blog->created_at->format('Y-m-d') }}</p>
                      @if($blog->file_path)
                          <a href="{{ asset('storage/' . $blog->file_path) }}" target="_blank" class="attachment-link">View attachment</a>
                      @endif
                  </li>
              @endforeach
          </ul>
      @endif

      <!-- 链接到发布新博客页面 -->
      <div class="mt-10 text-center">
          @if(Auth::check())
              <a href="{{ route('blogs.create') }}" class="bg-blue-700 text-white px-4 py-2 rounded hover:bg-blue-600">Publish a new blog</a>
          @else
              <button onclick="showLoginAlert()" class="bg-blue-700 text-white px-4 py-2 rounded">Publish a new blog</button>
              <script>
                  function showLoginAlert() {
                      alert('Please log in before posting a blog.');
                      window.location.href = "{{ url('/login') }}";
                  }
              </script>
          @endif
      </div>
  </div>
@endsection
