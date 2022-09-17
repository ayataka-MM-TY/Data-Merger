# Data Merger

## 概要
書式の異なるExcelファイルのmergeを行い、JSONでダウンロードが可能なWebアプリケーション

## setup

### 環境

- Deno 1.25.3
- PHP 8.1.10
- Composer 2.4.2
- MySQL 8.0.30

### composerの依存関係
```shell
composer install --ignore-platform-reqs
```

### envファイルの設定

.env.exampleをコピー
```shell
cp .env.example .env
```

.envファイルを書き換える
```shell
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=data_merger
DB_USERNAME=laravel
DB_PASSWORD=password
```

### App Keyを生成する
```shell
php artisan key:generate
```

### テスト用.envファイルを作成する
.envファイルをコピー
```shell
cp .env .env.testing
```

.env.testingを書き換える
```shell
DB_DATABASE=testing
```

### MySQLの設定
MySQLにログイン
```shell
mysql -u root -p
```

```sql
CREATE DATABASE data_merger;
CREATE DATABASE testing;
CREATE USER 'laravel'@'localhost' IDENTIFIED 'password';
GRANT ALL ON data_merger.* TO 'laravel'@'localhost';
GRANT ALL ON testing.* TO 'laravel'@'localhost';
```

**\\q**でMySQLからログアウトできる。

### マイグレーション
データベースが接続できているか、マイグレートして確認する

```shell
php artisan migrate
php artisan migrate --env=testing
```
