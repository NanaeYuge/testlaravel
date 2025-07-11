# testlaravel
for test-laravel
# FashionablyLate（確認テスト）

Laravelを用いたお問い合わせ管理アプリケーションです。管理者がユーザーからの問い合わせを一覧・検索・詳細確認・CSV出力できるシンプルな管理画面を備えています。

---

##  機能一覧
- ユーザー登録・ログイン（Fortify使用）
- お問い合わせフォーム
- 入力内容の確認画面
- お問い合わせ内容の管理画面（一覧・詳細モーダル・検索・削除・CSV出力）
- ページネーション（7件ずつ表示）

---

##  使用技術（実行環境）
- Laravel 8.x
- PHP 8.0
- MySQL 8.0
- Docker / Laravel Sail
- Composer
- Blade（ビュー）
- JavaScript（モーダル表示）
- Faker（ダミーデータ生成）

---

## 環境構築手順

## 🔧 環境構築

以下の手順で環境構築を行います。

### 1. Dockerコンテナのビルド・起動

```bash
docker compose build
docker compose up -d
docker compose exec app bash
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan db:seed

## 🗺 ER図

![ER図](https://github.com/user-attachments/assets/b952e9dd-5beb-4d4f-a6f2-b0b3246b4ef3)

---

## 🌐 URL

- 開発環境: `http://localhost`
