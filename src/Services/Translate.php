<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services;

abstract class Translate
{
    public abstract function translate(
        string $string,
        string $targetLang,
        string $sourceLang = 'en_GB'
    ): ?string;
}
