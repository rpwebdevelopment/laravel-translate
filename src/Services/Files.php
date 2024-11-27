<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services;

use RPWebDevelopment\LaravelTranslate\Exceptions\SourceNotFoundException;

class Files
{
    protected array $structure = [];
    protected string $filetype = 'php';
    protected string $directory = '/resources/lang';

    public function __construct(string $filetype, string $directory)
    {
        $this->filetype = $this->cleanString($filetype);
        $this->directory = DIRECTORY_SEPARATOR . $this->cleanString($directory);
    }

    /** @throws SourceNotFoundException */
    public function parse(string $sourceLang, string $targetLang, ?string $file = null): self
    {
        $this->setScanStructure($sourceLang, $targetLang, $file);

        return $this;
    }

    public function getStructure(): array
    {
        return $this->structure;
    }

    /** @throws SourceNotFoundException */
    private function setScanStructure(string $sourceLang, string $targetLang, ?string $file): void
    {
        $sourceLang = $this->cleanString($sourceLang);
        $path = $this->directory . DIRECTORY_SEPARATOR . $sourceLang;
        $target = $this->directory . DIRECTORY_SEPARATOR . $targetLang;
        $targetFile = $target . '.' . $this->filetype;
        $pathFile = $path . '.' . $this->filetype;

        if ($file) {
            $filename = $this->hasFileExtension($file) ? $file : $file . '.' . $this->filetype;
            $path = $path . DIRECTORY_SEPARATOR . $filename;
            $targetFile = $target . DIRECTORY_SEPARATOR . $filename;

            if (!is_file($path)) {
                throw new SourceNotFoundException();
            }

            $this->structure = [$path => $targetFile];

            return;
        }

        if ($this->hasFileExtension($sourceLang) && is_file($path)) {
            $this->structure = [$path => $targetFile];

            return;
        }

        if (!$this->hasFileExtension($sourceLang) && is_dir($path)) {
            $search = $path . DIRECTORY_SEPARATOR . '*.' . $this->filetype;

            foreach (glob($search) as $file) {
                $this->structure[$file] = $target . DIRECTORY_SEPARATOR . basename($file);
            }

            return;
        }

        if (!$this->hasFileExtension($sourceLang) && is_file($pathFile)) {
            $this->structure = [$pathFile => $targetFile];

            return;
        }

        throw new SourceNotFoundException();
    }

    private function cleanString(string $string): string
    {
        return rtrim(ltrim($string, ' /.'), ' /');
    }

    private function hasFileExtension(string $path): bool
    {
        return str_ends_with($path,  '.' . $this->filetype);
    }
}
