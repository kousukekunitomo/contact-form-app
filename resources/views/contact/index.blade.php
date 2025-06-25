@extends('layouts.app')

@section('title', 'お問い合わせフォーム')

@section('css')
<link rel="stylesheet" href="{{ asset('css/contact.css') }}">
@endsection

@section('content')
<div class="form-container">
    <h2>Contact</h2>

    <form action="{{ route('contact.confirm') }}" method="POST">
        @csrf

        <!-- お名前 -->
        <div class="form-group">
            <label>お名前<span class="required-mark">※</span></label>
            <div class="form-input">
                <div class="name-inputs">
                    <input type="text" name="last_name" placeholder="例: 山田" value="{{ old('last_name') }}">
                    <input type="text" name="first_name" placeholder="例: 太郎" value="{{ old('first_name') }}">
                </div>
                @error('last_name')<div class="error">{{ $message }}</div>@enderror
                @error('first_name')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- 性別 -->
        <div class="form-group">
            <label>性別<span class="required-mark">※</span></label>
            <div class="form-input">
                <div class="radio-group">
                    <label><input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}> 男性</label>
                    <label><input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}> 女性</label>
                    <label><input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}> その他</label>
                </div>
                @error('gender')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- メールアドレス -->
        <div class="form-group">
            <label>メールアドレス<span class="required-mark">※</span></label>
            <div class="form-input">
                <input type="text" name="email" placeholder="例: test@example.com" value="{{ old('email') }}">
                @error('email')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- 電話番号 -->
        <div class="form-group">
            <label>電話番号<span class="required-mark">※</span></label>
            <div class="form-input">
                <div class="tel-input-group">
                    <input type="text" name="tel1" maxlength="5" value="{{ old('tel1') }}">
                    <span class="tel-separator">-</span>
                    <input type="text" name="tel2" maxlength="5" value="{{ old('tel2') }}">
                    <span class="tel-separator">-</span>
                    <input type="text" name="tel3" maxlength="5" value="{{ old('tel3') }}">
                </div>
                {{-- バリデーションメッセージを1つにまとめる --}}
                @if ($errors->get('tel_combined'))
                @foreach ($errors->get('tel_combined') as $error)
                    <div class="error">{{ $error }}</div>
                @endforeach
                @endif
            </div>
        </div>
        <!-- 住所 -->
        <div class="form-group">
            <label>住所<span class="required-mark">※</span></label>
            <div class="form-input">
                <input type="text" name="address" placeholder="例: 東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">
                @error('address')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- 建物名 -->
        <div class="form-group">
            <label>建物名</label>
            <div class="form-input">
                <input type="text" name="building" placeholder="例: 千駄ヶ谷マンション101" value="{{ old('building') }}">
            </div>
        </div>

        <!-- お問い合わせの種類 -->
        <div class="form-group">
            <label>お問い合わせの種類<span class="required-mark">※</span></label>
            <div class="form-input">
                <select name="category_id">
                    <option value="">選択してください</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- お問い合わせ内容 -->
        <div class="form-group">
            <label>お問い合わせ内容<span class="required-mark">※</span></label>
            <div class="form-input">
                <textarea name="detail" placeholder="お問い合わせ内容をご記載ください">{{ old('detail') }}</textarea>
                @error('detail')<div class="error">{{ $message }}</div>@enderror
            </div>
        </div>

        <!-- ボタン -->
        <div class="form-buttons">
            <button type="submit">確認画面</button>
        </div>
    </form>
</div>
@endsection
