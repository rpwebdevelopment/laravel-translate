<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

abstract class Reader
{
    protected array $files = [];
    protected array $targets = [];
    protected array $existing = [];

    public function read(array $files, bool $missingOnly = false): Reader
    {
        $this->files = $files;
        $this->targets = [];
        $this->existing = [];

        foreach ($this->files as $file => $target) {
            $this->targets[$target] = $this->readFile($file);

            if ($missingOnly) {
                $this->existing[$target] = (is_file($target)) ? $this->readFile($target) : [];
            }
        }

        return $this;
    }

    public function getFiles(): array
    {
        return $this->files;
    }

    public function getTargets(): array
    {
        return $this->targets;
    }

    public function getExisting(): array
    {
        return $this->existing;
    }

    protected abstract function readFile(string $filepath): array;
}
