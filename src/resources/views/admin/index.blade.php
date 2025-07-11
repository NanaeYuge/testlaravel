<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FashionablyLate Admin</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="header">
        <h1 class="logo">FashionablyLate</h1>
        <form method="POST" action="{{ route('logout') }}" class="logout-form">
            @csrf
            <button type="submit" class="logout-btn">logout</button>
        </form>
    </header>

    <main class="admin-main">
        <h2 class="admin-title">Admin</h2>

        <div class="search-form">
        <form method="GET" action="{{ route('admin.index') }}">
            <input type="text" name="keyword" placeholder="名前やメールアドレスを入力してください">

    <select name="gender">
            <option value="all">性別</option>
        <option value="1" {{ request('gender') == '1' ? 'selected' : '' }}>男性</option>
        <option value="2" {{ request('gender') == '2' ? 'selected' : '' }}>女性</option>
        <option value="3" {{ request('gender') == '3' ? 'selected' : '' }}>その他</option>
    </select>

    <select name="type">
        <option value="">お問い合わせの種類</option>
        <option value="商品のお届けについて" {{ request('type') == '商品のお届けについて' ? 'selected' : '' }}>商品のお届けについて</option>
        <option value="商品の交換について" {{ request('type') == '商品の交換について' ? 'selected' : '' }}>商品の交換について</option>
        <option value="商品トラブル" {{ request('type') == '商品トラブル' ? 'selected' : '' }}>商品トラブル</option>
        <option value="ショップへのお問い合わせ" {{ request('type') == 'ショップへのお問い合わせ' ? 'selected' : '' }}>ショップへのお問い合わせ</option>
        <option value="その他" {{ request('type') == 'その他' ? 'selected' : '' }}>その他</option>
    </select>

        <input type="date"  name="date" value="{{ request('date') }}">
            <button class="search-btn">検索</button>
            <a href="{{ route('admin.index') }}" class="reset-btn">リセット</a>
    </form>
</div>

<div class="export-pagination-wrapper">
    <div class="export-area">
        <form method="GET" action="{{ route('admin.export') }}">
        <input type="hidden" name="keyword" value="{{ request('keyword') }}">
        <input type="hidden" name="email" value="{{ request('email') }}">
            <input type="hidden" name="gender" value="{{ request('gender') }}">
            <input type="hidden" name="type" value="{{ request('type') }}">
            <input type="hidden" name="date" value="{{ request('date') }}">
            <button type="submit" class="export-btn">エクスポート</button>
        </form>
    </div>

    <div class="pagination-links">
        {!! $contacts->onEachSide(1)->links() !!}
    </div>
</div>


</div>

        <table class="contact-table">
            <thead>
                <tr>
                    <th>お名前</th>
                    <th>性別</th>
                    <th>メールアドレス</th>
                    <th>お問い合わせの種類</th>
                </tr>
            </thead>
            <tbody>
            @foreach($contacts as $contact)
<tr>
    <td>{{ $contact->last_name }}　{{ $contact->first_name }}</td>
    <td>{{ $contact->gender === 1 ? '男性' : ($contact->gender === 2 ? '女性' : 'その他') }}</td>
    <td>{{ $contact->email }}</td>
    <td>{{ $contact->category->content ?? '' }}</td>
    <td>
        <button class="open-modal" data-id="{{ $contact->id }}">詳細</button>
    </td>
</tr>
@endforeach
</tbody>
</table>

<!-- モーダル -->
<div id="modal" class="modal" style="display: none;">
    <div class="modal-content">
        <span class="close">&times;</span>
    <div id="modal-body">
    </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const modal = document.getElementById('modal');
    const modalBody = document.getElementById('modal-body');
    const closeBtn = document.querySelector('.close');
    const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    document.querySelectorAll('.open-modal').forEach(button => {
        button.addEventListener('click', function () {
            const contactId = this.getAttribute('data-id');

            fetch(`/admin/contact/${contactId}`)
                .then(response => response.json())
                .then(data => {
                    modalBody.innerHTML = `
                        <p><strong>お名前：</strong> ${data.last_name} ${data.first_name}</p>
                        <p><strong>性別：</strong> ${data.gender === 1 ? '男性' : data.gender === 2 ? '女性' : 'その他'}</p>
                        <p><strong>メール：</strong> ${data.email}</p>
                        <p><strong>電話番号：</strong> ${data.tel1 ?? ''}-${data.tel2 ?? ''}-${data.tel3 ?? ''}</p>
                        <p><strong>住所：</strong> ${data.address ?? ''} ${data.building ?? ''}</p>
                        <p><strong>お問い合わせの種類：</strong> ${data.category_content ?? ''}</p>
                        <p><strong>お問い合わせ内容：</strong> ${data.message ?? ''}</p>

                        <form id="deleteForm" action="#">
                            <input type="hidden" name="_token" value="${csrfToken}">
                            <button type="submit" class="modal-delete-btn">削除</button>
                        </form>
                    `;

                    modal.style.display = 'block';

                    const deleteForm = document.getElementById('deleteForm');
                    deleteForm.addEventListener('submit', function (e) {
                        e.preventDefault();

                        if (!confirm('本当に削除しますか？')) return;

                        fetch(`/admin/${data.id}`, {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken,
                                'X-Requested-With': 'XMLHttpRequest'
                            },
                            body: JSON.stringify({
                                _method: 'DELETE'
                            })
                        })
                        .then(response => response.json())
                        .then(result => {
                            if (result.success) {
                                alert('削除しました');
                                modal.style.display = 'none';
                                location.reload();
                            } else {
                                alert('削除に失敗しました');
                            }
                        })
                        .catch(() => {
                            alert('通信エラーが発生しました');
                        });
                    });
                })
                .catch(error => {
                    modalBody.innerHTML = '<p>読み込みに失敗しました。</p>';
                    modal.style.display = 'block';
                });
        });
    });

    closeBtn.addEventListener('click', function () {
        modal.style.display = 'none';
    });

    window.addEventListener('click', function (event) {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
    });
});
</script>

    </main>
</body>
</html>
