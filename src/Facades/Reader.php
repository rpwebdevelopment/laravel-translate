<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;
use RPWebDevelopment\LaravelTranslate\Contracts\Reader as ReaderAlias;

/**
 * @See ReaderAlias
 * @method ReaderAlias read(array $files)
 * @method array getTargets()
 */
class Reader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'reader';
    }
}
