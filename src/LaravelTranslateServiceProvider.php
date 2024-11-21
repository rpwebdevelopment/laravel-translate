<?php

namespace RPWebDevelopment\LaravelTranslate;

use RPWebDevelopment\LaravelTranslate\Services\Translate;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RPWebDevelopment\LaravelTranslate\Commands\LaravelTranslateCommand;

class LaravelTranslateServiceProvider extends PackageServiceProvider
{
    public function boot()
    {
        $provider = config('translate.provider', 'google');

        $this->app->bind(
            Translate::class,
            config("translate.providers.{$provider}.package")
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
