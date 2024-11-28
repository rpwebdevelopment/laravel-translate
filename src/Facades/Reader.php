<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;
use RPWebDevelopment\LaravelTranslate\Contracts\Reader as ReaderContract;

/**
 * @See ReaderContract
 * @method ReaderContract read(array $files, bool $missingOnly = false)
 * @method array getTargets()
 */
class Reader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'reader';
    }
}
