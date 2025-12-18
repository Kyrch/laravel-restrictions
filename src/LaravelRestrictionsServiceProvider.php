<?php

declare(strict_types=1);

namespace Kyrch\LaravelRestrictions;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;

class LaravelRestrictionsServiceProvider extends PackageServiceProvider
{
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
