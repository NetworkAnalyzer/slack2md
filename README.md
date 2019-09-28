# Easy Multi-Auth implementation with Laravel

[![Latest Version on Packagist](https://img.shields.io/packagist/v/nojiri1098/laravel-adminlte-for-back.svg?style=flat-square)](https://packagist.org/packages/nojiri1098/laravel-adminlte-for-back)
[![Build Status](https://travis-ci.org/nojiri1098/laravel-adminlte-for-back.svg?branch=master)](https://travis-ci.org/nojiri1098/laravel-adminlte-for-back)

This package provides an easy way to quickly implement Multi-Auth with Laravel 5.8.

To implement Multi-Auth, just execuse `make:mutliauth` Artisan command after `make:auth` Artisan command.

## Requirements

- Laravel 5.8.x
- PHP >= 7.1
- Laravel-AdminLTE

## Installation

```
composer require nojiri1098/laravel-multiauth
```

## Usage

### Preparetion

```
php artisan make:auth
php artisan migrate
```

### Implement Multi-Auth

```
php artisan make:multiauth
php artisan migrate
```
