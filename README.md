# Restrict your models 

[![Latest Version on Packagist](https://img.shields.io/packagist/v/kyrch/laravel-prohibitions.svg?style=flat-square)](https://packagist.org/packages/kyrch/laravel-prohibitions)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/kyrch/laravel-prohibitions/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/kyrch/laravel-prohibitions/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/kyrch/laravel-prohibitions/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/kyrch/laravel-prohibitions/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/kyrch/laravel-prohibitions.svg?style=flat-square)](https://packagist.org/packages/kyrch/laravel-prohibitions)

## Installation

You can install the package via composer:

```bash
composer require kyrch/laravel-prohibitions
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="laravel-prohibitions-migrations"
php artisan migrate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="laravel-prohibitions-config"
```

Add the `HasSanctions` trait to your User model:

```php
use Kyrch\Prohibitions\Traits\HasSanctions;

class User extends Authenticatable
{
    use HasSanctions;
}
```

Now you can use methods this packages provides, such as:

```php
# Restrict the user to update any posts.
$user->prohibit('update post', now()->addWeek());

# Similar to roles, you can create a kind of "ban preset" that has a group of prohibitions.
$user->applySanction('comments', now()->addWeek());

# Check if user is prohibited from execute an action.
$user->isProhibitedFrom('update post');
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
