<?php

namespace RPWebDevelopment\LaravelTranslate;

use RPWebDevelopment\LaravelTranslate\Services\Files;
use Spatie\LaravelPackageTools\Package;
use Spatie\LaravelPackageTools\PackageServiceProvider;
use RPWebDevelopment\LaravelTranslate\Commands\LaravelTranslateCommand;

class LaravelTranslateServiceProvider extends PackageServiceProvider
{
    public function boot(): PackageServiceProvider
    {
        $dir = config('translate.lang_directory');
        $reader = config('translate.reader', 'php');
        $provider = config('translate.provider', 'google');

        $readerClass = config("translate.readers.{$reader}");
        $writerClass = config("translate.writers.{$reader}");
        $providerClass = config("translate.providers.{$provider}.package");

        $this->app->bind(
            'translate',
            fn () => new ($providerClass)()
        );

        $this->app->bind(
            'reader',
            fn () => new ($readerClass)()
        );

        $this->app->bind(
            'writer',
            fn () => new ($writerClass)()
        );

        $this->app->bind(
            'file-processor',
            fn () => new Files($reader, $dir)
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
