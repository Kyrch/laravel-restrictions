<?php

declare(strict_types=1);

namespace Kyrch\Prohibition;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class ProhibitionServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        $this->publishes([
            __DIR__.'/../config/prohibition.php' => config_path('prohibition.php'),
        ], 'laravel-prohibitions-config');

        $this->publishes([
            __DIR__.'/../database/migrations' => database_path('migrations'),
        ], 'laravel-prohibitions-migrations');

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
            ->name('laravel-prohibitions')
            ->hasConfigFile('prohibition')
            ->hasMigration('create_prohibition_tables');
    }
}
