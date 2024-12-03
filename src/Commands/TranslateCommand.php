<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Illuminate\Console\Command;
use RPWebDevelopment\LaravelTranslate\Facades\FileProcessor;
use RPWebDevelopment\LaravelTranslate\Facades\Reader;
use RPWebDevelopment\LaravelTranslate\Facades\Translate;
use RPWebDevelopment\LaravelTranslate\Facades\Writer;
use Symfony\Component\Console\Helper\ProgressBar;

class TranslateCommand extends Command
{
    protected bool $missingOnly = false;
    protected ?string $source = null;
    protected ?string $file = null;

    protected function processForTargetLanguage(string $target): void
    {
        ProgressBar::setFormatDefinition('custom', ' %message% [%bar%] %current%/%max% ');
        $progress = $this->output->createProgressBar();
        $progress->setFormat('custom');

        $files = FileProcessor::parse($this->source, $target, $this->file)->getStructure();
        $reader = Reader::read($files, $this->missingOnly);

        $translations = Translate::reader($reader, $target, $this->source, $progress);
        Writer::write($translations, $this);
    }

    protected function setOptions(): void
    {
        $this->source = $this->option('source') ?? config('translate.default_source');
        $this->file = $this->option('file');
        $this->missingOnly  = $this->option('missing-only');
    }
}
