<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Exception;
use Illuminate\Console\Command;
use RPWebDevelopment\LaravelTranslate\Facades\FileProcessor;
use RPWebDevelopment\LaravelTranslate\Facades\Reader;
use RPWebDevelopment\LaravelTranslate\Facades\Translate;
use RPWebDevelopment\LaravelTranslate\Facades\Writer;
use Symfony\Component\Console\Helper\ProgressBar;

class LaravelBulkTranslateCommand extends Command
{
    public $signature = 'laravel-translate:bulk
        { --source= : source language to derive translations from }
        { --file= : specific file to generate translations for }
        { --missing-only : specify if only missing translations required }';

    public $description = 'Processes and stores translations from source file';

    public function handle(): int
    {
        $this->info('Loading source...');
        $targets = config('translate.target_locales', []);
        $source = $this->option('source') ?? config('translate.default_source');
        $file = $this->option('file');
        $missingOnly  = $this->option('missing-only');
        ProgressBar::setFormatDefinition('custom', ' %message% [%bar%] %current%/%max% ');

        try {
            foreach ($targets as $target) {
                $progress = $this->output->createProgressBar();
                $progress->setFormat('custom');

                $files = FileProcessor::parse($source, $target, $file)->getStructure();
                $reader = Reader::read($files, $missingOnly);

                $translations = Translate::reader($reader, $target, $source, $progress);
                Writer::write($translations, $this);
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->comment('Complete');

        return self::SUCCESS;
    }
}
