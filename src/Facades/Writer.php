<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Facade;
use RPWebDevelopment\LaravelTranslate\Contracts\Writer as WriterContract;

/**
 * @See WriterContract
 * @method void write(array $translationFiles, Command $command)
 */
class Writer extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'writer';
    }
}
