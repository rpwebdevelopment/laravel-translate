<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Exception;

class LaravelTranslateCommand extends TranslateCommand
{
    public $signature = 'laravel-translate
        { target : "target_locale" to be translated into }
        { --source= : source language to derive translations from }
        { --file= : specific file to generate translations for }
        { --missing-only : specify if only missing translations required }';

    public $description = 'Processes and stores translations from source file';

    public function handle(): int
    {
        $this->setOptions();
        $this->info('Loading source...');
        $target = $this->argument('target');
        $lang = config("translate.target_locales.{$target}");

        try {
            $this->processForTargetLanguage($lang, $target);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->comment('Complete');

        return self::SUCCESS;
    }
}
