<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @See \RPWebDevelopment\LaravelTranslate\Services\Translate
 * @method static ?string translate(string $string, string $targetLang, string $sourceLang = 'en_GB')
 */
class Translate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'translate';
    }
}
