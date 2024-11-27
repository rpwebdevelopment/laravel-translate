<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

use Symfony\Component\Console\Helper\ProgressBar;

abstract class Translate
{
    protected array $targets = [];
    public ProgressBar $progressBar;
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
        $this->targets = $reader->getTargets();
        $this->progressBar = $progress;
        $this->sourceLanguage = $sourceLang;
        $this->targetLanguage = $targetLang;

        $this->progressBar->setMessage('Translating values');
        $this->progressBar->start(count($this->targets, 1));

        array_walk_recursive($this->targets, [$this, 'processArray']);

        $this->progressBar->finish();

        return $this->targets;
    }

    private function processArray(&$value): void
    {
        $value = $this->cleanAttributes($value);
        $value = $this->translate($value, $this->targetLanguage, $this->sourceLanguage);
        $value = $this->restoreAttributes($value);
        $this->progressBar->advance();
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
