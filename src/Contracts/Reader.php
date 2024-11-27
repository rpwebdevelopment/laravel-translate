<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

abstract class Reader
{
    protected array $files = [];

    public function read(array $files): Reader
    {
        $this->files = $files;

        foreach ($this->files as $file => $target) {
            $this->files[$file] = $this->readFile($file);
        }

        return $this;
    }

    protected abstract function readFile(string $filepath): array;
}
