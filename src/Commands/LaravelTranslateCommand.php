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
    public $signature = 'laravel-translate
        {lang? : The language being translated into}
        {--source= : The filepath for the lang files to be translated}';

    public $description = 'Processes and stores translations from source file';

    public function handle(): int
    {
        $this->info('Loading source...');
        $source = $this->option('source') ?? 'en';

        try {
            $files = FileProcessor::parse($source)->getStructure();
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
