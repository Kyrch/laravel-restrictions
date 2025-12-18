<?php

declare(strict_types=1);

namespace Kyrch\Restriction;

use Kyrch\Restriction\Contracts\Restriction;
use Kyrch\Restriction\Contracts\Sanction;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class RestrictionServiceProvider extends PackageServiceProvider
{
    public function boot(): void
    {
        $this->registerModelBindings();
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

    protected function registerModelBindings(): void
    {
        $this->app->bind(Restriction::class, fn ($app) => $app->make($app->config['restriction.models.restriction']));
        $this->app->bind(Sanction::class, fn ($app) => $app->make($app->config['restriction.models.sanction']));
    }
}
