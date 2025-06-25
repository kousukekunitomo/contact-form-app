<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'お問い合わせアプリ')</title>

    <link href="https://fonts.googleapis.com/css2?family=Inika&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        body {
            font-family: 'Inika', serif;
            background-color: #ffffff;
            color: #333;
        }

        header {
            width: 100%;
            background-color: #ffffff;
        }

        .header-container {
            width: 100%;
            height: 100px;
            background-color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 0 20px;
        }

        .site-title {
            font-size: 40px;
            font-family: 'Inika', serif;
            color: #8B7969;
            margin: 0;
            z-index: 1;
        }

        .header-button-area {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            z-index: 2;
        }

        .auth-link-btn,
        .logout-btn {
            background-color: transparent;
            border: 1px solid #d6c3b0;
            color: #d6c3b0;
            padding: 6px 12px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 13px;
            text-decoration: none;
        }

        .auth-link-btn:hover,
        .logout-btn:hover {
            background-color: #f3ece7;
            color: #7b6651;
            border-color: #cdb7a0;
        }
    </style>

    @yield('css')
</head>
<body>

<header style="border-bottom: 1px solid #E0DFDE; width: 100%;">
    <div class="header-container">
        <h1 class="site-title">FashionablyLate</h1>

        <div class="header-button-area">
            @if (Str::startsWith(request()->path(), 'admin'))
                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button class="logout-btn" type="submit">logout</button>
                </form>
            @else
                @yield('header-button')
            @endif
        </div>
    </div>
</header>

@yield('content')
@yield('scripts')

</body>
</html>
