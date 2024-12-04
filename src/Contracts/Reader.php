<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

abstract class Reader
{
    protected array $files = [];
    protected array $targets = [];
    protected array $existing = [];
    protected array $missing = [];

    public function read(array $files, bool $missingOnly = false): Reader
    {
        $this->files = $files;
        $this->missing = [];
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

    public function hasMissing(string $target): array
    {
        $this->readMissing($this->targets, $this->existing, $this->missing);

        return $this->formatMissing($target);
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

    private function readMissing(&$target, $source, &$missing): void
    {
        foreach ($target as $key => $value) {
            if (is_array($value)) {
                $source[$key] = $source[$key] ?? [];
                $missing[$key] = $missing[$key] ?? [];
                $this->readMissing($target[$key], $source[$key], $missing[$key]);

                if (empty($missing[$key])) {
                    unset($missing[$key]);
                }

                continue;
            }

            if (
                isset($target[$key]) && !empty($target[$key])
                && (!isset($source[$key]) || empty($source[$key]))
            ) {
                $missing[$key] = true;
            }
        }

        array_filter($missing);
    }

    private function formatMissing(string $target): array
    {
        $returns = [];

        foreach ($this->missing as $file => $missing) {
            foreach (array_keys(array_dot($missing)) as $value) {
                $returns[] = [$target, $file, $value];
            }
        }

        return $returns;
    }

    protected abstract function readFile(string $filepath): array;
}
