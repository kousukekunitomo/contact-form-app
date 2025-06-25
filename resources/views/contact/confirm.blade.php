@extends('layouts.app')

@section('title', '確認画面')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="form-container">
    <h2>Confirm</h2>

    <table class="confirm-table">
        <tr>
            <th>お名前</th>
            <td>{{ $inputs['last_name'] }} {{ $inputs['first_name'] }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>
                @php
                    $genders = ['1' => '男性', '2' => '女性', '3' => 'その他'];
                @endphp
                {{ $genders[$inputs['gender']] ?? '' }}
            </td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $inputs['email'] }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td>
        </tr>
        <tr>
            <th>住所</th>
            <td>{{ $inputs['address'] }}</td>
        </tr>
        <tr>
            <th>建物名</th>
            <td>{{ $inputs['building'] }}</td>
        </tr>
        <tr>
            <th>お問い合わせの種類</th>
            <td>{{ $categories->firstWhere('id', $inputs['category_id'])->content ?? '' }}</td>
        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{!! nl2br(e($inputs['detail'])) !!}</td>
        </tr>
    </table>

    <div class="form-buttons">
        {{-- 送信フォーム --}}
        <form action="{{ route('contact.store') }}" method="POST">
            @csrf
            @foreach ($inputs as $key => $value)
                @if(in_array($key, ['tel1', 'tel2', 'tel3']))
                    @continue
                @endif
                @if(is_array($value))
                    @foreach($value as $subValue)
                        <input type="hidden" name="{{ $key }}[]" value="{{ $subValue }}">
                    @endforeach
                @else
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endif
            @endforeach
            <input type="hidden" name="tel" value="{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}">
            <button type="submit" name="action" value="submit">送信</button>
        </form>

        {{-- 戻るフォーム --}}
       <form action="{{ route('contact.index') }}" method="POST">
    @csrf
    @foreach ($inputs as $key => $value)
        @if(is_array($value))
            @foreach($value as $subValue)
                <input type="hidden" name="{{ $key }}[]" value="{{ $subValue }}">
            @endforeach
        @else
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endif
    @endforeach
    <button type="submit" class="back-button">修正</button>
</form>
    </div>
</div>
@endsection
