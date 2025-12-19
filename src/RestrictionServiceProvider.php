<?php

declare(strict_types=1);

namespace Kyrch\Restriction;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RestrictionServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/restriction.php' => config_path('restriction.php'),
        ], 'laravel-restrictions-config');

         $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'laravel-restrictions-migrations');

        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
    }

    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-restrictions')
            ->hasConfigFile('restriction')
            ->hasMigration('create_restriction_tables');
    }
}
