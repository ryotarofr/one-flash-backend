\q

## インストール手順

プロジェクトセットアップ

```bash
composer create-project laravel/laravel app-name
```

```bash
composer require laravel/sail --dev
```

```bash
./vendor/bin/sail
```

```bash
alias sail='./vendor/bin/sail'
```

### make StudentController

```bash
 sail artisan make:controller StudentController
```

### make StudentModel

```bash
 sail artisan make:model Student -m
```

`-m`: this is default migration command

### migrate after change model scheme

```bash
sail artisan migrate
```

### add data at SQL format

```bash
INSERT INTO students (name, email, phone, created_at, updated_at) VALUES ('John Doe', 'john@example.com', '123-456-7890', NOW(), NOW());
```

reponse web view `{"status":200,"student":[{"id":1,"name":"John Doe","email":"john@example.com","phone":"123-456-7890","created_at":"2024-01-07T02:20:57.000000Z","updated_at":"2024-01-07T02:20:57.000000Z"}]}`
