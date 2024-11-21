<?php

namespace RPWebDevelopment\LaravelTranslate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RPWebDevelopment\LaravelTranslate\Commands\LaravelTranslateCommand;

class LaravelTranslateServiceProvider extends PackageServiceProvider
{
    public function configurePackage(Package $package): void
    {
        /*
         * This class is a Package Service Provider
         *
         * More info: https://github.com/spatie/laravel-package-tools
         */
        $package
            ->name('laravel-translate')
            ->hasConfigFile()
            ->hasViews()
            ->hasMigration('create_laravel_translate_table')
            ->hasCommand(LaravelTranslateCommand::class);
    }
}
