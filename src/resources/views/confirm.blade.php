@extends('layouts.app')

@section('content')
<div class="header">
        <div class="logo">FashionablyLate</div>
</div>

<main class="confirm-container">
    <h3 class="confirm-title">Confirm</h3>

    @php
        $genders = [1 => '男性', 2 => '女性', 3 => 'その他'];
    @endphp

    <form method="POST" action="{{ route('send') }}">
        @csrf
        <table class="confirm-table">
            <tr><th>お名前</th><td>{{ $inputs['last_name'] }}　{{ $inputs['first_name'] }}</td></tr>
            <tr><th>性別</th><td>{{ $genders[$inputs['gender']] ?? '未設定' }}</td></tr>
            <tr><th>メールアドレス</th><td>{{ $inputs['email'] }}</td></tr>
            <tr><th>電話番号</th><td>{{ $inputs['tel1'] }}-{{ $inputs['tel2'] }}-{{ $inputs['tel3'] }}</td></tr>
            <tr><th>住所</th><td>{{ $inputs['address'] }}</td></tr>
            <tr><th>建物名</th><td>{{ $inputs['building'] }}</td></tr>
            <tr><th>お問い合わせの種類</th><td>{{ $categoryName }}</td></tr>
            <tr><th>お問い合わせ内容</th><td>{!! nl2br(e($inputs['message'])) !!}</td></tr>
        </table>

        {{-- hidden inputs --}}
        @foreach($inputs as $key => $val)
            <input type="hidden" name="{{ $key }}" value="{{ $val }}">
        @endforeach

        <div class="button-container">
            <button type="submit" name="action" value="submit" class="submit-btn">送信</button>
            <button type="submit" name="action" value="back" class="back-button">修正</button>
        </div>
    </form>
</main>
@endsection
