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
        $providerClass = config("translate.providers.{$provider}.package");

        $this->app->instance(
            Translate::class,
            $this->app->make($providerClass)
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
