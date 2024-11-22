<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Reader;

use RPWebDevelopment\LaravelTranslate\Contracts\Reader;

class PhpReader extends Reader
{
    protected function readFile(string $filepath): array
    {
        $content = require $filepath;

        if (!is_array($content)) {
            return [];
        }

        return $content;
    }
}
