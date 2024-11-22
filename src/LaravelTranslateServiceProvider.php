<?php

namespace RPWebDevelopment\LaravelTranslate;

use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RPWebDevelopment\LaravelTranslate\Commands\LaravelTranslateCommand;

class LaravelTranslateServiceProvider extends PackageServiceProvider
{
    public function boot(): PackageServiceProvider
    {
        $reader = config('translate.reader', 'php');
        $provider = config('translate.provider', 'google');

        $readerClass = config("translate.readers.{$reader}");
        $providerClass = config("translate.providers.{$provider}.package");

        $this->app->bind(
            'translate',
            fn () => new ($providerClass)()
        );

        $this->app->bind(
            'reader',
            fn () => new ($readerClass)()
        );

        return parent::boot();
    }

    public function configurePackage(Package $package): void
    {
        $package
            ->name('laravel-translate')
            ->hasConfigFile()
            ->hasCommand(LaravelTranslateCommand::class);
    }
}
