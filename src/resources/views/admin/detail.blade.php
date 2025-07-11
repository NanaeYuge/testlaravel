@extends('layouts.app')

@section('content')
<div class="container">
    <h2>お問い合わせ詳細</h2>

    <table>
        <tr>
            <th>姓</th>
            <td>{{ $contact->last_name }}</td>
        </tr>
        <tr>
            <th>名</th>
            <td>{{ $contact->first_name }}</td>
        </tr>
        <tr>
            <th>性別</th>
            <td>{{ ['1' => '男性', '2' => '女性', '3' => 'その他'][$contact->gender] ?? '未設定' }}</td>
        </tr>
        <tr>
            <th>メールアドレス</th>
            <td>{{ $contact->email }}</td>
        </tr>
        <tr>
            <th>電話番号</th>
            <td>{{ $contact->tel }}</td>
        </tr>
        <tr>
            <th>お問い合わせ種類</th>
            <td>{{ $contact->category->content ?? '未設定' }}</td>

        </tr>
        <tr>
            <th>お問い合わせ内容</th>
            <td>{{ $contact->detail }}</td>

        </tr>
        <tr>
            <th>お問い合わせ日</th>
            <td>{{ $contact->created_at->format('Y/m/d') }}</td>
        </tr>
    </table>

    <br>

    {{-- 削除フォーム --}}
    <form method="POST" action="{{ route('admin.destroy', $contact->id) }}" onsubmit="return confirm('本当に削除しますか？')">
        @csrf
        @method('DELETE')
        <button type="submit" class="btn-danger">削除</button>
    </form>

    <br>
    <a href="{{ route('admin.index') }}" class="btn-secondary">一覧に戻る</a>

    <style>
table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
}

th {
    background-color: #a98c6d;
    color: white;
    text-align: left;
    padding: 10px;
    width: 180px;
}

td {
    border: 1px solid #ddd;
    padding: 10px;
}

.btn-secondary {
    background-color: #ccc;
    padding: 8px 16px;
    border-radius: 6px;
    text-decoration: none;
    color: #000;
    font-weight: bold;
}

.btn-danger {
    background-color: #d9534f;
    padding: 8px 16px;
    border-radius: 6px;
    border: none;
    color: #fff;
    cursor: pointer;
}
</style>

</div>


@endsection
