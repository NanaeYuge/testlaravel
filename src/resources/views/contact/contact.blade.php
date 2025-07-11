<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate - Contact</title>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&display=swap" rel="stylesheet">
<style>
    body {
        background-color: white;
        font-family: 'Helvetica Neue', sans-serif;
        margin: 0;
    }

    .header {
    background-color: #fff;
    padding: 20px 40px;
    text-align: center;
    border-bottom: 1px solid #ddd;
}

    .logo {
        font-family: 'Playfair Display', serif;
        font-size: 28px;
        font-weight: bold;
        color: #86776a;
    }


    h2, h3 {
        text-align: center;
        color: #8e7a6b;
        margin-bottom: 10px;
        font-family: 'Playfair Display', serif;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    th {
        text-align: left;
        padding: 10px 15px;
        vertical-align: top;
        width: 35%;
        color: #86776a;
        font-size: 15px;
        font-family: 'Playfair Display', serif;
    }

    td {
        padding: 10px 15px;
    }

    input[type="text"],
    input[type="email"],
    input[type="tel"],
    textarea,
    select {
        width: 100%;
        padding: 15px;
        font-size: 12px;
        border: none;
        border-radius: 5px;
        background-color: #f5f5f5;
        color: #86776a;
    }

    .custom-radio {
    position: relative;
    padding-left: 30px;
    margin-right: 20px;
    cursor: pointer;
    font-size: 14px;
    color: #8e7a6b;
}

.custom-radio input[type="radio"] {
    opacity: 0;
    position: absolute;
    left: 0;
}

.radio-mark {
    position: absolute;
    left: 0;
    top: 2px;
    height: 13px;
    width: 13px;
    background-color: white;
    border: 1px solid #8e7a6b;
    border-radius: 50%;
}

.custom-radio input[type="radio"]:checked + .radio-mark {
    background-color: #8e7a6b;
}

.radio-mark::after {
    content: "";
    position: absolute;
    display: none;
}

.custom-radio input[type="radio"]:checked + .radio-mark::after {
    display: block;
}

.radio-mark::after {
    display: none;
}

select {
    appearance: none;
    -webkit-appearance: none;
    -moz-appearance: none;
    background-color: #f5f5f5;
    padding: 8px 40px 8px 12px;
    border: 1px solid #ccc;
    border-radius: 4px;
    background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='10' height='6'%3E%3Cpath fill='%238e7a6b' d='M0 0l5 6 5-6z'/%3E%3C/svg%3E");
    background-repeat: no-repeat;
    background-position: right 10px center;
    background-size: 16px 10px;
}


    .submit-btn {
        text-align: center;
        margin-top: 20px;
    }

    .submit-btn button {
        background-color: #827569;
        color: white;
        padding: 10px 30px;
        border: none;
        border-radius: 2px;
        font-size: 16px;
        cursor: pointer;
    }

    .example-input {
        color: #aaa;
        font-size: 12px;
        margin-top: 5px;
    }

    .required {
        color: red;
        font-weight: bold;
    }

    .tel-row {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .tel-row input[type="tel"] {
        width: 80px;
    }

    .name-row {
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .name-row input[type="text"] {
        width: 120px;
    }

    .error {
        color: red;
        font-size: 0.875em;
        margin-top: 5px;
}

</style>
</head>
<body>
    <div class="header">
        <div class="logo">FashionablyLate</div>
    </div>
        <h3>Contact</h3>
        <form action="{{ route('confirm') }}" method="POST">
        @csrf
        <table>
        <tr>
            <th>お名前 <span class="required">※</span></th>
                <td class="name-row">
                    <input type="text" name="last_name" placeholder="例：山田" value="{{ old('last_name') }}">
                    @error('last_name')
                        <p class="error">{{ $message }}</p>
                    @enderror
                    <input type="text" name="first_name" placeholder="例：太郎" value="{{ old('first_name') }}">
                    @error('first_name')
                            <p class="error">{{ $message }}</p>
                    @enderror
                </td>
        </tr>
        <tr>
            <th>性別 <span class="required">※</span></th>
                <td>
                <div class="radio-group">
                <label class="custom-radio">
                    <input type="radio" name="gender" value="1" {{ old('gender', '1') == '1' ? 'checked' : '' }}>
                        <span class="radio-mark"></span> 男性
                </label>
                <label class="custom-radio">
                    <input type="radio" name="gender" value="2" {{ old('gender') == '2' ? 'checked' : '' }}>
                        <span class="radio-mark"></span> 女性
                </label>
                <label class="custom-radio">
                    <input type="radio" name="gender" value="3" {{ old('gender') == '3' ? 'checked' : '' }}>
                        <span class="radio-mark"></span> その他
                </label>

                    @error('gender')
                            <p class="error">{{ $message }}</p>
                    @enderror
                </div>

                </td>
        </tr>
        <tr>
            <th>メールアドレス <span class="required">※</span></th>
                <td><input type="email" name="email" placeholder="例：test@example.com" value="{{ old('email') }}">
                @error('email')
                        <p class="error">{{ $message }}</p>
                @enderror
            </td>
        </tr>
        <tr>
            <th>電話番号 <span class="required">※</span></th>
            <td class="tel-row">
                    <input type="tel" name="tel1" placeholder="080" value="{{ old('tel1') }}"> -
                    <input type="tel" name="tel2" placeholder="1234" value="{{ old('tel2') }}"> -
                    <input type="tel" name="tel3" placeholder="5678" value="{{ old('tel3') }}">
                    @if ($errors->has('tel1') || $errors->has('tel2') || $errors->has('tel3'))
                    <p class="error">電話番号を入力してください</p>
                    @endif
                </td>
        </tr>
        <tr>
            <th>住所 <span class="required">※</span></th>
                <td><input type="text" name="address" placeholder="例：東京都渋谷区千駄ヶ谷1-2-3" value="{{ old('address') }}">@error('address')
                    <p class="error">{{ $message }}</p>
                @enderror
                </td>
        </tr>
        <tr>
            <th>建物名</th>
                <td><input type="text" name="building" placeholder="例：千駄ヶ谷マンション101" value="{{ old('building') }}"></td>
        </tr>
        <tr>
            <th>お問い合わせの種類 <span class="required">※</span></th>
                <td>
                <select name="category_id">
                    <option value="">選択してください</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->content }}
                    </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="error">{{ $message }}</p>
                @enderror
                </td>
        </tr>
        <tr>
            <th>お問い合わせ内容 <span class="required">※</span></th>
                <td><textarea rows="5" name="message" placeholder="お問い合わせ内容をご記載ください">{{ old('message') }}</textarea>
                @error('message')
                        <p class="error">{{ $message }}</p>
                @enderror
                </td>
        </tr>
        </table>
        <div class="submit-btn">
        <button type="submit">確認画面</button>
        </div>
    </form>
</hr>
</body>
</html>
