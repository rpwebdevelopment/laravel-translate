<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Translate;

use DeepL\DeepLException;
use DeepL\Translator;
use RPWebDevelopment\LaravelTranslate\Contracts\Translate;
use RPWebDevelopment\LaravelTranslate\Exceptions\LanguageNotSupportedException;

class DeeplTranslate extends Translate
{
    protected Translator $translator;

    protected const SOURCE_LANGUAGE_CODES = [
        'ar_AA' => 'ar',
        'bg_BG' => 'bg',
        'cs_CZ' => 'cs',
        'da_DK' => 'da',
        'de_DE' => 'de',
        'el_GR' => 'el',
        'en_AU' => 'en',
        'en_BE' => 'en',
        'en_GB' => 'en',
        'en_US' => 'en',
        'en_ZA' => 'en',
        'es_ES' => 'es',
        'et_ET' => 'et',
        'fi_FI' => 'fi',
        'fr_BE' => 'fr',
        'fr_CA' => 'fr',
        'fr_CH' => 'fr',
        'fr_FR' => 'fr',
        'hu_HU' => 'hu',
        'id_ID' => 'id',
        'it_CH' => 'it',
        'it_IT' => 'it',
        'ja_JP' => 'ja',
        'lt_LT' => 'lt',
        'lv_LV' => 'lv',
        'nl_NL' => 'nl',
        'nl_BE' => 'nl',
        'pl_PL' => 'pl',
        'pt_BR' => 'pt',
        'pt_PT' => 'pt',
        'ro_RO' => 'ro',
        'ru_RU' => 'ru',
        'sk_SK' => 'sk',
        'sl_SL' => 'sl',
        'sv_SE' => 'sv',
        'tr_TR' => 'tr',
        'uk_UA' => 'uk',
        'zh_CN' => 'zh',
    ];

    protected const TARGET_LANGUAGE_CODES = [
        'ar_AA' => 'ar',
        'bg_BG' => 'bg',
        'cs_CZ' => 'cs',
        'da_DK' => 'da',
        'de_DE' => 'de',
        'el_GR' => 'el',
        'en_AU' => 'en-AU',
        'en_BE' => 'en',
        'en_GB' => 'EN-GB',
        'en_US' => 'en-US',
        'en_ZA' => 'en',
        'es_ES' => 'es',
        'et_ET' => 'et',
        'fi_FI' => 'fi',
        'fr_BE' => 'fr',
        'fr_CA' => 'fr',
        'fr_CH' => 'fr',
        'fr_FR' => 'fr',
        'hu_HU' => 'hu',
        'id_ID' => 'id',
        'it_CH' => 'it',
        'it_IT' => 'it',
        'ja_JP' => 'ja',
        'lt_LT' => 'lt',
        'lv_LV' => 'lv',
        'nl_NL' => 'nl',
        'nl_BE' => 'nl',
        'pl_PL' => 'pl',
        'pt' => 'pt',
        'pt_BR' => 'pt-BR',
        'pt_PT' => 'pt-PT',
        'ro_RO' => 'ro',
        'ru_RU' => 'ru',
        'sk_SK' => 'sk',
        'sl_SL' => 'sl',
        'sv_SE' => 'sv',
        'tr_TR' => 'tr',
        'uk_UA' => 'uk',
        'zh_CN' => 'zh',
    ];

    /** @throws DeepLException */
    public function __construct()
    {
        $this->translator = new Translator(config('translate.providers.deepl.token'));
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
        $target = $this->formatTargetLanguageString($targetLang);
        $source = $this->formatSourceLanguageString($sourceLang);

        return $this->translator->translateText($string, $source, $target)->text;
    }

    /** @throws LanguageNotSupportedException */
    private function formatSourceLanguageString(string $languageCode): string
    {
        return $this->formatLanguageString($languageCode, self::SOURCE_LANGUAGE_CODES);
    }

    /** @throws LanguageNotSupportedException */
    private function formatTargetLanguageString(string $languageCode): string
    {
        return $this->formatLanguageString($languageCode, self::TARGET_LANGUAGE_CODES);
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
