<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services;

use RPWebDevelopment\LaravelTranslate\Services\Translate;
use Deepl\Translator;

class DeeplTranslate extends Translate
{
    protected Translator $translator;

    public function __construct()
    {
        $this->translator = new Translator(config('translate.providers.deepl.token'));
    }

    public function translate(
        string $string,
        string $targetLang,
        string $sourceLang = 'en_GB'
    ): ?string {
        return $this->translator->translateText($string, $sourceLang, $targetLang)->text;
    }
}
