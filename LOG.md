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
