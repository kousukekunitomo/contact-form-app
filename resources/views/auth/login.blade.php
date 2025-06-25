@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/auth.css') }}">
<style>
    body {
        background-color: #f1e9e2;
        font-family: 'Inika', serif;
        color: #8B7969;
    }

    .login-container {
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

    .register-link-btn {
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

    .register-link-btn:hover {
        background-color: #f3ece7;
        color: #7b6651;
        border-color: #cdb7a0;
    }

    .error {
        color: #d9534f;
        font-size: 14px;
        margin-top: -16px;
        margin-bottom: 16px;
        display: block;
        text-align: left;
        white-space: normal; /* ← 折り返し有効にする */
        word-break: break-word; /* ← 長い文字列でも折り返す */
        }


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


</style>


@endsection


@section('content')
<div class="login-wrapper">
<h1 class="login-title">Login</h1>
    {{-- 登録画面へのリンク --}}
    @section('header-button')
        <a href="{{ route('register') }}" class="auth-link-btn">register</a>
    @endsection
    <div class="login-container">

    <form method="POST" action="{{ route('login') }}">
        @csrf

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

        <button type="submit">ログイン</button>
    </form>
</div>
@endsection

