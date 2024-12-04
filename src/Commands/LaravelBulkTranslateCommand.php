<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Exception;

class LaravelBulkTranslateCommand extends TranslateCommand
{
    public $signature = 'laravel-translate:bulk
        { --source= : source language to derive translations from }
        { --file= : specific file to generate translations for }
        { --missing-only : specify if only missing translations required }';

    public $description = 'Processes and stores translations from source file for all known targets';

    public function handle(): int
    {
        $this->setOptions();
        $this->info('Loading source...');
        $targets = config('translate.target_locales', []);

        try {
            foreach ($targets as $target) {
                $this->processForTargetLanguage($target);
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->comment('Complete');

        return self::SUCCESS;
    }
}
