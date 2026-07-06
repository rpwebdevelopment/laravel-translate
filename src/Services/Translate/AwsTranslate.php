<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Translate;

use Aws\AwsClient;
use Aws\Translate\TranslateClient;
use RPWebDevelopment\LaravelTranslate\Contracts\Translate;
use RPWebDevelopment\LaravelTranslate\Exceptions\InvalidFormalityConfigException;
use RPWebDevelopment\LaravelTranslate\Exceptions\LanguageNotSupportedException;
use RPWebDevelopment\LaravelTranslate\LanguageCodes;

final class AwsTranslate extends Translate
{
    protected TranslateClient|AwsClient $translateClient;
    protected array $translateSettings;

    public const REPLACE_FORMAT = '<template translate=no>%s</template>';
    public const REVERSE_FORMAT = '/(<template translate=no>)([\w\s]+)(<\/template>)/';
    public const MATCH_INT = 2;

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
     * @throws InvalidFormalityConfigException
     */
    protected function setFormality(array $locale): void
    {
        if (!isset($locale['formality'])) {
            $this->formality = "FORMAL";

            return;
        }

        if (!in_array($locale['formality'], ['less_formal', 'more_formal'])) {
            throw new InvalidFormalityConfigException();
        }

        $this->formality = $locale['formality'] === 'more_formal'
            ? 'FORMAL'
            : 'INFORMAL';
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
                'Settings' => $this->formatSettings(),
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
        if (in_array($code, LanguageCodes::AWS_CODES, true)) {
            return $code;
        }

        if (isset(LanguageCodes::AWS_CODES[$code])) {
            return LanguageCodes::AWS_CODES[$code];
        }

        throw new LanguageNotSupportedException();
    }

    private function formatSettings(): array
    {
        $settings = $this->translateSettings;
        $settings['Formality'] = $this->formality;

        return $settings;
    }
}
