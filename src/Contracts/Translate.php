<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

use Symfony\Component\Console\Helper\ProgressBar;

abstract class Translate
{
    protected array $files = [];
    protected array $targets = [];
    protected array $existing = [];
    public ProgressBar $progressBar;
    protected array $existingValues = [];
    protected string $sourceLanguage = '';
    protected string $targetLanguage = '';

    public abstract function translate(
        string $string,
        string $targetLang,
        string $sourceLang = 'en_GB'
    ): ?string;

    public function reader(
        Reader $reader,
        string $targetLang,
        string $sourceLang,
        ProgressBar $progress
    ): array {
        $this->files = $reader->getFiles();
        $this->targets = $reader->getTargets();
        $this->existing = $reader->getExisting();
        $this->progressBar = $progress;
        $this->sourceLanguage = $sourceLang;
        $this->targetLanguage = $targetLang;

        (empty($this->existing))
            ? $this->defaultProcessReader()
            : $this->missingOnlyProcessReader();

        return $this->targets;
    }

    private function defaultProcessReader(): void
    {
        $this->progressBar->setMessage("[{$this->targetLanguage}] Translating values");
        $this->progressBar->start(count($this->targets, 1));

        array_walk_recursive($this->targets, [$this, 'processArray']);

        $this->progressBar->finish();
    }

    private function missingOnlyProcessReader(): void
    {
        $this->progressBar->setMessage("[{$this->targetLanguage}] Translating values");
        $this->progressBar->start(count($this->files, 1));

        foreach ($this->files as $targetFile) {
            $this->processMissing($this->targets[$targetFile], $this->existing[$targetFile]);
            $this->progressBar->advance();
        }

        $this->progressBar->finish();
    }

    private function processArray(&$value): void
    {
        $value = $this->translateString($value);
        $this->progressBar->advance();
    }

    private function processMissing(&$target, $source): void
    {
        foreach ($target as $key => $value) {
            if (is_array($value)) {
                $source[$key] = $source[$key] ?? [];
                $this->processMissing($target[$key], $source[$key] ?? []);

                continue;
            }

            if (isset($source[$key]) && !empty($source[$key])) {
                $target[$key] = $source[$key];

                continue;
            }

            if (isset($target[$key]) && (!isset($source[$key]) || empty($source[$key]))) {
                $target[$key] = $this->translateString($target[$key]);
            }
        }
    }

    private function translateString(string $string): string
    {
        $value = $this->cleanAttributes($string);
        $value = $this->translate($value, $this->targetLanguage, $this->sourceLanguage);

        return $this->restoreAttributes($value);
    }

    private function cleanAttributes(string $value): string
    {
        return preg_replace_callback(
            '/\:[a-zA-Z0-9_-]*/',
            fn ($matches) => sprintf('*VAR_%s_VAR*', $matches[0]),
            $value
        );
    }

    private function restoreAttributes(string $value): string
    {
        return preg_replace_callback(
            '/\*VAR_(.*?)_VAR\*/',
            fn ($matches) => $matches[1],
            $value
        );
    }
}
