@extends('layouts.app')

@section('content')
<style>
body {
    margin: 0;
    padding: 0;
    background-color: #f4ede7;
    font-family: 'Helvetica Neue', sans-serif;
    color: #6e4d37;
}

header {
    background-color: #ffffff;
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 24px 40px;
    border-bottom: 1px solid #ddd;
}

header h1 {
    margin: 0;
    font-size: 24px;
    color: #8e8477;
    font-family: 'Playfair Display', serif;
}

h2{
    font-family: 'Playfair Display', serif;
    color: #8e8477;
    margin-top: 30px;
    text-align: center;
}

header .login-btn {
    background-color: #f5f6f6;
    color: #d9c5b5;
    padding: 6px 14px;
    text-decoration: none;
    font-weight: bold;
    border-radius: none;
    font-size: 14px;
    font-family: 'Playfair Display', serif;
    position: absolute;
    right: 20px;
    border: 1px solid #d9c5b5;
}

.register-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    padding: 20px 0;
    background-color: #f2ece7;
}

/* 登録カード */
.register-card {
    background-color: #ffffff;
    padding: 60px;
    border-radius: 6px;
    border: 1px solid #dfdddb;
    width: 400px;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
    text-align: left;
    margin: 40px auto;
}

label {
    display: block;
    margin-bottom: 6px;
    font-weight: bold;
    color: #a89d9a;
    font-family: 'Noto Sans JP', sans-serif;
}

input[type="text"],
input[type="email"],
input[type="password"] {
    width: 100%;
    padding: 10px 14px;
    margin-bottom: 20px;
    border: none;
    border-radius: none;
    background-color: #f5f5f5;
    font-size: 14px;
}

input::placeholder {
    color: #aaa;
    font-size: 10px;
}

button[type="submit"] {
    width: 30%;
    padding: 6px, 0;
    background-color: #837566;
    border: none;
    color: white;
    border-radius: none;
    font-size: 14px;
    font-weight: bold;
    cursor: pointer;
    display: block;
    margin: 10px auto;
    font-family: 'Noto Sans JP', sans-serif;
}

button[type="submit"]:hover {
    opacity: 0.9;gn:
}

.error-message {
    color: red;
    font-size: 13px;
    margin-top: -12px;
    margin-bottom: 16px;
}
</style>

<header>
    <h1>FashionablyLate</h1>
    <a href="{{ route('login') }}" class="login-btn">login</a>
</header>
<h2>Register</h2>
<div class="register-wrapper">
    <div class="register-card">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <label for="name">お名前</label>
            <input type="text" name="name" placeholder="例：山田　太郎" value="{{ old('name') }}">
            @error('name')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="email">メールアドレス</label>
            <input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
            @error('email')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <label for="password">パスワード</label>
            <input type="password" name="password" placeholder="例：coachtechno6">
            @error('password')
                <div class="error-message">{{ $message }}</div>
            @enderror

            <button type="submit">登録</button>
        </form>
    </div>
</div>


@endsection
