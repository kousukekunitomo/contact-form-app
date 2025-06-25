@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{ asset('css/admin.css') }}">
@endsection

@section('content')
<div class="wrapper">

    {{-- 成功メッセージ --}}
    @if(session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    {{-- ページタイトル --}}
    <div class="page-header">
        <h2 class="page-title">Admin</h2>
    </div>

    {{-- 検索フォーム --}}
    <div class="search-form-wrapper">
        <form method="GET" action="{{ route('admin.contacts.index') }}" class="search-form">
            <input type="text" name="name" value="{{ request('name') }}" placeholder="名前やメールアドレスを入力してください">

            <select name="gender">
                <option value="">性別</option>
                <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
                <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
                <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
            </select>

            <select name="category_id">
                <option value="">お問い合わせの種類</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->content }}
                    </option>
                @endforeach
            </select>

            <input type="date" name="date" value="{{ request('date') }}">

            <div class="form-buttons">
                <button type="submit" class="search-btn">検索</button>
                <a href="{{ route('admin.contacts.index') }}" class="reset-btn">リセット</a>
            </div>
        </form>
    </div>

    {{-- エクスポートボタン + ページネーション --}}
    <div class="table-controls">
        <a href="{{ route('admin.contacts.export', request()->query()) }}" class="export-btn">エクスポート</a>
        <div class="pagination-wrapper">
            {{ $contacts->appends(request()->query())->links('vendor.pagination.default') }}
        </div>
    </div>

    {{-- 一覧テーブル --}}
    <table class="contact-table">
        <thead>
            <tr>
                <th class="col-name">お名前</th>
                <th class="col-gender">性別</th>
                <th class="col-email">メールアドレス</th>
                <th class="col-category">お問い合わせの種類</th>
                <th class="col-detail">詳細</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($contacts as $contact)
                <tr>
                    <td class="col-name">{{ $contact->last_name }} {{ $contact->first_name }}</td>
                    <td class="col-gender">
                        @if ($contact->gender == 1) 男性
                        @elseif ($contact->gender == 2) 女性
                        @else その他
                        @endif
                    </td>
                    <td class="col-email">{{ $contact->email }}</td>
                    <td class="col-category">{{ $contact->category->content ?? '-' }}</td>
                    <td class="col-detail">
                        <a href="#modal-{{ $contact->id }}" class="detail-btn">詳細</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- モーダルウィンドウ --}}
    @foreach ($contacts as $contact)
    <div id="modal-{{ $contact->id }}" class="modal">
        <div class="modal-content">
            <a href="#" class="close-btn">&times;</a>
            <table class="modal-table">
                <tr><th>お名前</th><td>{{ $contact->last_name }} {{ $contact->first_name }}</td></tr>
                <tr><th>性別</th><td>
                    @if ($contact->gender == 1) 男性
                    @elseif ($contact->gender == 2) 女性
                    @else その他
                    @endif
                </td></tr>
                <tr><th>メールアドレス</th><td>{{ $contact->email }}</td></tr>
                <tr><th>電話番号</th><td>{{ $contact->tel }}</td></tr>
                <tr><th>住所</th><td>{{ $contact->address }}</td></tr>
                <tr><th>建物名</th><td>{{ $contact->building }}</td></tr>
                <tr><th>お問い合わせの種類</th><td>{{ $contact->category->content ?? '-' }}</td></tr>
                <tr><th>お問い合わせ内容</th><td>{!! nl2br(e($contact->detail)) !!}</td></tr>
            </table>
            <form method="POST" action="{{ route('admin.contacts.destroy', $contact->id) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="delete-btn">削除</button>
            </form>
        </div>
    </div>
    @endforeach

</div>
@endsection
