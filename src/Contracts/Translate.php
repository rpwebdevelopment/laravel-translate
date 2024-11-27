<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

abstract class Translate
{
    public abstract function translate(
        string $string,
        string $targetLang,
        string $sourceLang = 'en_GB'
    ): ?string;

    public function reader(Reader $reader): array
    {
        $targets = $reader->getTargets();
        dd($targets);

        return $targets;
    }
}
