@extends('layouts.app')

@section('title', '登録')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<style>
    body {
        background-color: #f1e9e2;
        font-family: 'Inika', serif;
        color: #8B7969;
    }

    .register-container {
        max-width: 580px;
        margin: 60px auto;
        padding: 40px;
        background-color: #ffffff;
        border-radius: 8px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        position: relative;
    }

    h1 {
        text-align: center;
        font-size: 28px;
        margin-bottom: 32px;
        color: #6f4e37;
    }

    label {
        display: block;
        margin-bottom: 8px;
        font-weight: bold;
        text-align: left;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        margin-bottom: 24px;
        border: 1px solid #ddd;
        background-color: #f7f7f7;
        border-radius: 4px;
        color: #8B7969;
    }

    button {
        background-color: #8B7969;
        color: white;
        border: none;
        padding: 10px 24px;
        border-radius: 4px;
        cursor: pointer;
        display: block;
        margin: 0 auto;
    }

    .login-link-btn {
        position: absolute;
        top: 20px;
        right: 20px;
        background-color: transparent;
        border: 1px solid #d6c3b0;
        color: #d6c3b0;
        padding: 8px 16px;
        border-radius: 4px;
        font-size: 14px;
        text-decoration: none;
    }

    .login-link-btn:hover {
        background-color: #f3ece7;
        color: #7b6651;
        border-color: #cdb7a0;
    }

    /* プレースホルダーの色とフォント */
input::placeholder {
    color: #8B7969;
    font-family: 'Inika', serif;
}

input::-webkit-input-placeholder {
    color: #8B7969;
    font-family: 'Inika', serif;
}

input::-moz-placeholder {
    color: #8B7969;
    font-family: 'Inika', serif;
}

input:-ms-input-placeholder {
    color: #8B7969;
    font-family: 'Inika', serif;
}

input::-ms-input-placeholder {
    color: #8B7969;
    font-family: 'Inika', serif;
}

.error {
    color: #d9534f;
    font-size: 14px;
    margin-top: -16px;
    margin-bottom: 16px;
    display: block;
    text-align: left;
}

.register-wrapper {
    max-width: 580px;
    margin: 60px auto;
    text-align: center;
}

.register-title {
    font-size: 28px;
    margin-bottom: 20px;
    color: #6f4e37;
    font-family: 'Inika', serif;
}
    
</style>
@endsection

@section('content')
<div class="register-wrapper">
<h1 class="register-title">Register</h1>

    {{-- ログイン画面へのリンク --}}
    @section('header-button')
        <a href="{{ route('login') }}" class="auth-link-btn">login</a>
    @endsection

    <div class="register-container">
    

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- 名前 -->
        <div>
            <label for="name">お名前</label>
            <input id="name" type="text" name="name" value="{{ old('name') }}" placeholder="例: 山田　太郎" autofocus>
            @error('name')
                <div class="error">{{ $message }}</div>
            @enderror
            
        </div>

        <!-- メールアドレス -->
        <div>
            <label for="email">メールアドレス</label>
            <input id="email" type="text" name="email" value="{{ old('email') }}" placeholder="例: test@example.com">
            @error('email')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        <!-- パスワード -->
        <div>
            <label for="password">パスワード</label>
            <input id="password" type="password" name="password" placeholder="例: coachtech106">
            @error('password')
                <div class="error">{{ $message }}</div>
            @enderror
        </div>

        {{-- <!-- パスワード確認 -->
        <div>
            <label for="password_confirmation">パスワード（確認）</label>
            <input id="password_confirmation" type="password" name="password_confirmation">
        </div>
        --}}

        <button type="submit">登録</button>
    </form>
</div>
@endsection
