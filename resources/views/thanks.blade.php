@extends('layouts.app')

@section('title', '送信完了')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
<style>
    .thanks-container {
        text-align: center;
        padding: 120px 20px 180px;
        position: relative;
    }

    .thanks-container h1 {
        font-size: 18px;
        color: #7a6e63;
        margin-bottom: 50px;
        position: relative;
        z-index: 2;
    }

    .thanks-container .back-home-button {
        background-color: #7a6e63;
        color: #fff;
        padding: 10px 40px;
        border: none;
        border-radius: 5px;
        font-size: 14px;
        text-decoration: none;
        display: inline-block;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
        transition: background-color 0.3s ease;
        position: relative;
        z-index: 2;
        
    }

    .thanks-container .back-home-button:hover {
        background-color: #6b6057;
    }

    .thanks-container .background-text {
        font-size: 200px;
        color: #f5f3f1;
        position: absolute;
        top: 40px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 0;
        white-space: nowrap;
        user-select: none;
        pointer-events: none;
    }
</style>
@endsection

@section('content')
<div class="thanks-container">
    <div class="background-text">Thank you</div>
    <h1>お問い合わせありがとうございました</h1>
    <a href="{{ route('contact.index') }}" class="back-home-button">HOME</a>
</div>
@endsection
