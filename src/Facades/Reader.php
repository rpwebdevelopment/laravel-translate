<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;
use RPWebDevelopment\LaravelTranslate\Contracts\Reader as ReaderContract;

/**
 * @See ReaderContract
 *
 * @method static ReaderContract read(array $files, bool $missingOnly = false)
 * @method static array getTargets()
 * @method static array hasMissing(string $target)
 */
class Reader extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'reader';
    }
}
