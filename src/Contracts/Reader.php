<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

abstract class Reader
{
    protected string $reader = 'php';
    protected string $sourceFile = 'en_GB/*.php';
    protected string $directory = 'resources/lang/';
    protected string $searchPath = '';
    protected array $files = [];
    public bool $isDirectory = false;
    public bool $isFile = false;

    public function __construct()
    {
        $langDirectory = config('translate.lang_directory', '/resources/lang');
        $this->reader = config('translate.reader', 'php');
        $this->directory = rtrim($langDirectory, " /");
        $this->searchPath = $this->directory . DIRECTORY_SEPARATOR;
    }

    public function read($filePath = 'en'): Reader
    {
        $this->setSearchPath($filePath);

        foreach ($this->getFiles() as $file) {
            $this->files[$file] = $this->readFile($file);
        }

        return $this;
    }

    private function setSearchPath($filepath): void
    {
        $this->sourceFile = ltrim($filepath, " /");
        if (!str_ends_with($this->sourceFile, '.' . $this->reader)) {
            if (is_dir($this->searchPath . $this->sourceFile)) {
                $this->isDirectory = true;
                $this->sourceFile .= '*.' . $this->reader;
            } else {
                $this->isFile = true;
                $this->sourceFile .= '.' . $this->reader;
            }
        } else {
            $this->isFile = true;
        }

        $this->searchPath .= $this->sourceFile;
    }

    private function getFiles(): array
    {
        return glob($this->searchPath);
    }

    protected abstract function readFile(string $filepath): array;
}
