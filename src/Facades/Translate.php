<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;
use \RPWebDevelopment\LaravelTranslate\Contracts\Reader;

/**
 * @See \RPWebDevelopment\LaravelTranslate\Contracts\Translate
 * @method ?string translate(string $string, string $targetLang, string $sourceLang = 'en_GB')
 * @method array reader(Reader $reader)
 */
class Translate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'translate';
    }
}
