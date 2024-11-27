<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

abstract class Reader
{
    protected array $files = [];
    protected array $targets = [];

    public function read(array $files): Reader
    {
        $this->files = $files;

        foreach ($this->files as $file => $target) {
            $this->targets[$target] = $this->readFile($file);
        }

        return $this;
    }

    public function getTargets(): array
    {
        return $this->targets;
    }

    protected abstract function readFile(string $filepath): array;
}
