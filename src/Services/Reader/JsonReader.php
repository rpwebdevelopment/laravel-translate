<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Reader;

use RPWebDevelopment\LaravelTranslate\Contracts\Reader;

class JsonReader extends Reader
{
    protected function readFile(string $filepath): array
    {
        $json = file_get_contents($filepath);
        $content = json_decode($json, true);

        if (!is_array($content)) {
            return [];
        }

        return $content;
    }
}
