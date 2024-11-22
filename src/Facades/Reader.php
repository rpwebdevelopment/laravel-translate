<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;
use RPWebDevelopment\LaravelTranslate\Contracts\Reader as ReaderAlias;

/**
 * @See ReaderAlias
 * @method static ReaderAlias read(string $source = 'en')
 */
class Reader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'reader';
    }
}
