<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Exception;
use Illuminate\Console\Command;
use RPWebDevelopment\LaravelTranslate\Facades\FileProcessor;
use RPWebDevelopment\LaravelTranslate\Facades\Reader;
use RPWebDevelopment\LaravelTranslate\Facades\Translate;
use Symfony\Component\Console\Helper\ProgressBar;

class LaravelTranslateCommand extends Command
{
    public $signature = 'laravel-translate {target} {--source=}';

    public $description = 'Processes and stores translations from source file';

    public function handle(): int
    {
        $this->info('Loading source...');
        $target = $this->argument('target');
        $source = $this->option('source') ?? config('translate.default_source');

        try {
            ProgressBar::setFormatDefinition('custom', ' %message% [%bar%] %current%/%max% ');
            $progress = $this->output->createProgressBar();
            $progress->setFormat('custom');

            $files = FileProcessor::parse($source, $target)->getStructure();
            $reader = Reader::read($files);

            Translate::reader($reader, $target, $source, $progress);
        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
