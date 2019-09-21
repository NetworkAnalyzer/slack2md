
## Laravel 5.8

### Preparation

```
php artisan make:auth
php artisan migrate
```

### Make Multi-Auth

```
composer require nojiri1098/laravel-multiauth
php artisan make:multiauth
- generate Admin.php
- generate create_admins_table.php
- configure guard in app.php
- call(php artisan make:adminlte)
- call(php artisan vendor:publish --provider="JeroenNoten\LaravelAdminLte\ServiceProvider" --tag=assets)

php artisan migrate
```
