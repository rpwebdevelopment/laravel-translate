<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Translate;

use RPWebDevelopment\LaravelTranslate\Contracts\Translate;
use Stichoza\GoogleTranslate\GoogleTranslate as GoogleTranslateService;

class GoogleTranslate extends Translate
{
    protected GoogleTranslateService $translator;
    public function __construct()
    {
        $this->translator = new GoogleTranslateService();
    }

    public function translate(
        string $string,
        string $targetLang,
        string $sourceLang = 'en_GB'
    ): ?string {
        return $this->translator
            ->setSource($sourceLang)
            ->setTarget($targetLang)
            ->translate($string);
    }
}
