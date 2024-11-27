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

class LaravelTranslateCommand extends Command
{
    public $signature = 'laravel-translate
        { target : Target language to be translated into }
        { --source= : source language to derive translations from }
        { --file= : specific file to generate translations for }';

    public $description = 'Processes and stores translations from source file';

    public function handle(): int
    {
        $this->info('Loading source...');
        $target = $this->argument('target');
        $source = $this->option('source') ?? config('translate.default_source');
        $file = $this->option('file');

        try {
            ProgressBar::setFormatDefinition('custom', ' %message% [%bar%] %current%/%max% ');
            $progress = $this->output->createProgressBar();
            $progress->setFormat('custom');

            $files = FileProcessor::parse($source, $target, $file)->getStructure();
            $reader = Reader::read($files);

            $translations = Translate::reader($reader, $target, $source, $progress);
            Writer::write($translations, $this);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
