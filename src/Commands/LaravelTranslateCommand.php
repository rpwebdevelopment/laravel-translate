<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Exception;
use Illuminate\Console\Command;
use RPWebDevelopment\LaravelTranslate\Facades\FileProcessor;
use RPWebDevelopment\LaravelTranslate\Facades\Reader;
use RPWebDevelopment\LaravelTranslate\Facades\Translate;

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
            $files = FileProcessor::parse($source, $target)->getStructure();
            $reader = Reader::read($files);
            dd($reader, $files);

        } catch (Exception $e) {
            $this->error($e->getMessage());

            return self::FAILURE;
        }

        $this->comment('All done');

        return self::SUCCESS;
    }
}
