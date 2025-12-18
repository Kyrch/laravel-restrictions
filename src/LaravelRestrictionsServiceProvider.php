<?php

namespace Kyrch\LaravelRestrictions;

use Kyrch\LaravelRestrictions\Commands\LaravelRestrictionsCommand;
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
            ->hasConfigFile()
            ->hasMigration('create_laravel_restrictions_table')
            ->hasCommand(LaravelRestrictionsCommand::class);
    }
}
