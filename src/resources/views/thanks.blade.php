@extends('layouts.app')

@section('content')
<div class="thanks-wrapper">
    <div class="thanks-background">Thank you</div>

    <div class="thanks-content">
        <p class="thanks-message">お問い合わせありがとうございました</p>
        <form action="{{ route('contact.index') }}" method="get">
            <button type="submit" class="thanks-button">HOME</button>
        </form>
    </div>
</div>
@endsection
<style>
body {
    font-family: sans-serif;
    background-color: #fff;
    margin: 0;
    padding: 0;
    height: 100vh;
}

.thanks-wrapper {
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100%;
    flex-direction: column;
    position: relative;
    text-align: center;
}

.thanks-background {
    position: absolute;
    font-size: 120px;
    color: rgba(0, 0, 0, 0.03);
    font-family: 'Playfair Display', serif;
    white-space: nowrap;
    z-index: 0;
}

.thanks-content {
    z-index: 1;
}

.thanks-message {
    font-size: 18px;
    color: #7f7669;
    margin-bottom: 20px;
}

.thanks-button {
    padding: 10px 30px;
    background-color: #7f7669;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 14px;
}
</style>
