<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Exception;
use RPWebDevelopment\LaravelTranslate\Facades\FileProcessor;
use RPWebDevelopment\LaravelTranslate\Facades\Reader;

class HasMissingTranslationsCommand extends TranslateCommand
{
    public $signature = 'laravel-translate:missing';

    public $description = 'Discover if defined target languages have missing values';

    public function handle(): int
    {
        $this->source = config('translate.default_source');
        $targets = config('translate.target_locales', []);
        $verbose = $this->option('verbose');
        $missing = [];

        try {
            foreach ($targets as $target) {
                $files = FileProcessor::parse($this->source, $target, null)->getStructure();

                $missing = array_merge(
                    $missing,
                    Reader::read($files, true)->hasMissing($target, $verbose)
                );
            }

        } catch (Exception $e) {
            return self::FAILURE;
        }

        if (count($missing)) {
            if ($verbose) {
                $this->table(['Locale', 'File', 'Translation Key'], $missing);
            }

            return self::FAILURE;
        }

        return self::SUCCESS;
    }
}
