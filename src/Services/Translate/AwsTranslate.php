<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Translate;

use Aws\AwsClient;
use Aws\Translate\TranslateClient;
use RPWebDevelopment\LaravelTranslate\Contracts\Translate;
use RPWebDevelopment\LaravelTranslate\Exceptions\LanguageNotSupportedException;

class AwsTranslate extends Translate
{
    protected const LANGUAGE_CODES = [
        "af" => "af",
        "sq" => "sq",
        "am" => "am",
        "ar_AA" => "ar",
        "hy" => "hy",
        "az" => "az",
        "bn" => "bn",
        "bs" => "bs",
        "bg" => "bg",
        "bg_BG" => "bg",
        "ca" => "ca",
        "ca_AD" => "ca",
        "ca_ES" => "ca",
        "ca_FR" => "ca",
        "ca_IT" => "ca",
        "hr" => "hr",
        "hr_BA" => "hr",
        "hr_HR" => "hr",
        "cs" => "cs",
        "cs_CZ" => "cs",
        "da" => "da",
        "da_DK" => "da",
        "fa_AF" => "fa-AF",
        "prs_AF" => "fa-AF",
        "nl" => "nl",
        "nl_BE" => "nl",
        "nl_NL" => "nl",
        "en" => "en",
        "en_GB" => "en",
        "en_US" => "en",
        "en_AU" => "en",
        'en_ZA' => 'en',
        "et" => "et",
        "et_EE" => "et",
        "fi" => "fi",
        "fi_FI" => "fi",
        "fr" => "fr",
        "fr_FR" => "fr",
        "fr_CA" => "fr-CA",
        "ka" => "ka",
        "ka_GE" => "ka",
        "de" => "de",
        "de_DE" => "de",
        "el" => "el",
        "el_CY" => "el",
        "el_GR" => "el",
        "gu" => "gu",
        "gu_IN" => "gu",
        "ht" => "ht",
        "ha" => "ha",
        "ha_GH" => "ha",
        "ha_NE" => "ha",
        "ha_NG" => "ha",
        "he" => "he",
        "he_IL" => "he",
        "hi" => "hi",
        "hi_IN" => "hi",
        "hu" => "hu",
        "hu_HU" => "hu",
        "is" => "is",
        "is_IS" => "is",
        "id" => "id",
        "id_ID" => "id",
        "ga" => "ga",
        "ga_IE" => "ga",
        "it" => "it",
        "it_IT" => "it",
        "ja" => "ja",
        "ja_JP" => "ja",
        "kn" => "kn",
        "kn_IN" => "kn",
        "kk" => "kk",
        "kk_KZ" => "kk",
        "ko" => "ko",
        "ko_KR" => "ko",
        "lv" => "lv",
        "lv_LV" => "lv",
        "lt" => "lt",
        "lt_LT" => "lt",
        "mk" => "mk",
        "mk_MK" => "mk",
        "ms" => "ms",
        "ms_MY" => "ms",
        "ml" => "ml",
        "ml_IN" => "ml",
        "mt" => "mt",
        "mt_MT" => "mt",
        "mr" => "mr",
        "mn" => "mn",
        "no" => "no",
        "no_NO" => "no",
        "ps" => "ps",
        "fa" => "fa",
        "pl" => "pl",
        "pl_PL" => "pl",
        "pt" => "pt-PT",
        "pt_PT" => "pt-PT",
        "pt_BR" => "pt",
        "pa" => "pa",
        "ro" => "ro",
        "ro_RO" => "ro",
        "ru" => "ru",
        "ru_RU" => "ru",
        "sr" => "sr",
        "sr_BA" => "sr",
        "sr_CS" => "sr",
        "sr_ME" => "sr",
        "si" => "si",
        "sk" => "sk",
        "sk_SK" => "sk",
        "sl" => "sl",
        "so" => "so",
        "es" => "es",
        "es_ES" => "es",
        "es_MX" => "es-MX",
        "sw" => "sw",
        "sv" => "sv",
        "sv_SE" => "sv",
        "tl" => "tl",
        "ta" => "ta",
        "ta_ID" => "ta",
        "ta_IN" => "ta",
        "ta_MY" => "ta",
        "ta_MM" => "ta",
        "ta_MU" => "ta",
        "ta_PH" => "ta",
        "ta_SL" => "ta",
        "ta_SG" => "ta",
        "ta_TH" => "ta",
        "te" => "te",
        "th" => "th",
        "th_TH" => "th",
        "th_TH_TH" => "th",
        "tr" => "tr",
        "tr_TR" => "tr",
        "uk" => "uk",
        "uk_UA" => "uk",
        "ur" => "ur",
        "uz" => "uz",
        "uz_UZ" => "uz",
        "uz_AF" => "uz",
        "vi" => "vi",
        "vi_VN" => "vi",
        "cy" => "cy",
        "cy_GB" => "cy",
        "zh" => "zh",
        "zh_CN" => "zh",
        "zh_TW" => "zh-TW",
    ];

    protected TranslateClient|AwsClient $translateClient;
    protected array $translateSettings;

    public function __construct()
    {
        $this->translateSettings = config('translate.providers.aws.settings');

        $this->translateClient = TranslateClient::factory([
            'region' => config('translate.providers.aws.region'),
            'credentials' => [
                'key' => config('translate.providers.aws.credentials.key'),
                'secret' => config('translate.providers.aws.credentials.secret'),
            ]
        ]);
    }

    /**
     * @throws LanguageNotSupportedException
     */
    public function translate(string $string = '', string $targetLang, string $sourceLang = 'en_GB'): ?string
    {
        if ($string === '') {
            return $string;
        }

        return $this->translateClient
            ->translateText([
                'Settings' => $this->translateSettings,
                'SourceLanguageCode' => $this->formatCode($sourceLang),
                'TargetLanguageCode' => $this->formatCode($targetLang),
                'Text' => $string,
            ])
            ->get('TranslatedText');
    }

    /**
     * @throws LanguageNotSupportedException
     */
    private function formatCode(string $code = 'en_GB'): string
    {
        if (in_array($code, self::LANGUAGE_CODES, true)) {
            return $code;
        }

        if (isset(self::LANGUAGE_CODES[$code])) {
            return self::LANGUAGE_CODES[$code];
        }

        throw new LanguageNotSupportedException();
    }
}
