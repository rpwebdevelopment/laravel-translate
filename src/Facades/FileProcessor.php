<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;
use RPWebDevelopment\LaravelTranslate\Services\Files as FilesAlias;

/**
 * @See FilesAlias
 * @method parse(string $sourceLanguage, string $targetLanguage)
 */
class FileProcessor extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'file-processor';
    }
}
