<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Blog')</title>
    
    <!-- 引入 Tailwind CSS 和 Google Fonts -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600;700&display=swap" rel="stylesheet">
    
    <!-- 引入自定义 CSS 文件 -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    @yield('style')
    
    <style>
        html, body {
            height: 100%;
        }
        body {
            display: flex;
            flex-direction: column;
            font-family: 'Open Sans', sans-serif;
            background-color: #A7FB9E; 
        }
        .container {
            flex: 1; /* 主内容区域填充剩余空间 */
            width: 100%; /* 设置为全宽度 */
            margin: 0 auto; /* 将内容居中对齐 */
        }

        .center {
            flex: 1; /* 主内容区域填充剩余空间 */
            width: %; /* 设置为全宽度 */
            margin: 0 auto; /* 将内容居中对齐 */
            background: url('/images/background.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        footer {
            text-align: center;
            background-color: #1f2937; /* 深灰色背景 */
            color: white;
            padding: 1rem 0;
        }
    </style>
</head>
<body class="bg-gray-100 text-gray-800 leading-relaxed">
    <!-- 页头 -->
    <header class="bg-blue-600 p-4 shadow-md">
        <nav class="container mx-auto flex justify-between items-center">
            <div class="text-white text-2xl font-semibold">
                <a href="{{ url('/index') }}">AntBlog</a>
            </div>
            <div>
                <a href="{{ url('/index') }}" class="text-white hover:text-blue-300 ml-4">Home Page</a>
                <a href="{{ url('/personal') }}" class="text-white hover:text-blue-300 ml-4">Personal Center</a>
                
                @guest
                    <a href="{{ url('/login') }}" class="text-white hover:text-blue-300 ml-4">Login</a>
                    <a href="{{ url('/register') }}" class="text-white hover:text-blue-300 ml-4">Register</a>  
                @endguest
                @auth
                    <form action="{{ url('/logout') }}" method="POST" class="inline ml-4">
                        @csrf
                        <button type="submit" class="text-white hover:text-blue-300">Log out</button>
                    </form>
                @endauth
            </div>
        </nav>
    </header>

    <!-- 主内容区 -->
    <div class="center mx-auto mt-13 p-6 bg-white shadow-md rounded-lg w-full">
        @yield('content')
    </div>

    <!-- 页脚 -->
    <footer class="bg-gray-800 text-white p-4">
        <div class="container mx-auto">
            <p>© B01734437. AntBlog</p>
        </div>
    </footer>

    <script src="{{ asset('js/app.js') }}"></script>
    @yield('script')
</body>
</html>
