# Restrict your models 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kyrch/laravel-restrictions.svg?style=flat-square)](https://packagist.org/packages/kyrch/laravel-restrictions)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/kyrch/laravel-restrictions/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kyrch/laravel-restrictions/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/kyrch/laravel-restrictions/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/kyrch/laravel-restrictions/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/kyrch/laravel-restrictions.svg?style=flat-square)](https://packagist.org/packages/kyrch/laravel-restrictions)

## Installation

You can install the package via composer:

```bash
composer require kyrch/laravel-restrictions
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-restrictions-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-restrictions-config"
```

Add the `HasSanctions` trait to your User model:

```php
class User extends Authenticatable
{
    use HasSanctions;
}
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Kyrch](https://github.com/Kyrch)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
