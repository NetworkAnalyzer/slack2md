# Easy Multi-Auth implementation with Laravel

This package provides an easy way to quickly implement Multi-Auth with Laravel 5 and 6.

To implement Multi-Auth, just execuse `make:mutliauth` Artisan command after `make:auth` Artisan command.

## Requirements

- Laravel 5.8.x to 6.0.x
- PHP >= 7.1
- Laravel-AdminLTE

## Installation

1. Require the package using composer:
```
composer require nojiri1098/laravel-multiauth
```

2. Add the service provider to the `providers` in `config/app.php`:
```
JeroenNoten\LaravelAdminLte\ServiceProvider::class,
```

## Usage

### Preparetion

#### Laravel 5.8

```
php artisan make:auth
php artisan migrate
```

#### Laravel 6.0

```
composer require laravel/ui
php artisan ui vue --auth
php artisan migrate
npm install
npm run dev
```

### Implement Multi-Auth

```
php artisan make:multiauth
php artisan migrate
```
