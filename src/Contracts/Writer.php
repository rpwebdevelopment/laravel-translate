<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Contracts;

use Illuminate\Console\Command;
use RPWebDevelopment\LaravelTranslate\Exceptions\CannotCreateTargetFileException;
use RPWebDevelopment\LaravelTranslate\Exceptions\TargetFileNotFoundException;

abstract class Writer
{
    public Command $command;

    /**
     * @throws TargetFileNotFoundException
     * @throws CannotCreateTargetFileException
     */
    public function write(array $translationFiles, Command $command): void
    {
        $this->command = $command;

        foreach ($translationFiles as $filepath => $translations) {
            $this->validateFile($filepath);

            if (!$stream = fopen($filepath, 'w')) {
                throw new CannotCreateTargetFileException();
            }

            fclose($stream);

            $this->writeToFile($filepath, $translations);
        }
    }

    /** @throws TargetFileNotFoundException */
    private function validateFile(string $filepath): void
    {
        if (!is_file($filepath)) {
            $continue = $this->command->confirm("File doesn't exist: {$filepath}, create?", true);

            if (!$continue) {
                throw new TargetFileNotFoundException();
            }
        }
    }

    protected abstract function writeToFile(string $filepath, array $translations): void;
}
