<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Translate;

use DeepL\DeepLException;
use DeepL\Translator;
use RPWebDevelopment\LaravelTranslate\Contracts\Translate;
use RPWebDevelopment\LaravelTranslate\Exceptions\InvalidFormalityConfigException;
use RPWebDevelopment\LaravelTranslate\Exceptions\LanguageNotSupportedException;
use RPWebDevelopment\LaravelTranslate\LanguageCodes;

final class DeeplTranslate extends Translate
{
    protected Translator $translator;
    protected string $model = 'prefer_quality_optimized';

    /** @throws DeepLException */
    public function __construct()
    {
        $this->translator = new Translator(config('translate.providers.deepl.token'));
        $this->model = config('translate.providers.deepl.model_type', 'prefer_quality_optimized');
    }

    /**
     * @throws InvalidFormalityConfigException
     */
    protected function setFormality(array $locale): void
    {
        if (!isset($locale['formality'])) {
            $this->formality = "prefer_more";

            return;
        }

        if (!in_array($locale['formality'], ['less_formal', 'more_formal'])) {
            throw new InvalidFormalityConfigException();
        }

        $this->formality = $locale['formality'] === 'more_formal'
            ? 'prefer_more'
            : 'prefer_less';
    }

    /**
     * @throws LanguageNotSupportedException
     * @throws DeepLException
     */
    public function translate(
        string $string,
        string $targetLang,
        string $sourceLang = 'en_GB'
    ): ?string {
        return $this->translator
            ->translateText(
                $string,
                $this->formatSourceLanguageString($sourceLang),
                $this->formatTargetLanguageString($targetLang),
                [
                    'model_type' => $this->model,
                    'formality' => $this->formality,
                ]
            )
            ->text;
    }

    /** @throws LanguageNotSupportedException */
    private function formatSourceLanguageString(string $languageCode): string
    {
        return $this->formatLanguageString($languageCode, LanguageCodes::DEEPL_SOURCE_CODES);
    }

    /** @throws LanguageNotSupportedException */
    private function formatTargetLanguageString(string $languageCode): string
    {
        return $this->formatLanguageString($languageCode, LanguageCodes::DEEPL_TARGET_CODES);
    }

    /** @throws LanguageNotSupportedException */
    private function formatLanguageString(string $languageCode, array $codes): string
    {
        $languageCode = str_replace('-', '_', $languageCode);

        if (in_array($languageCode, $codes)) {
            return $languageCode;
        }

        if (isset($codes[$languageCode])) {
            return $codes[$languageCode];
        }

        throw new LanguageNotSupportedException();
    }
}
