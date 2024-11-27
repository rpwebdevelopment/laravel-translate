<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Writer;

use RPWebDevelopment\LaravelTranslate\Contracts\Writer;

class JsonWriter extends Writer
{

    protected function writeToFile(string $filepath, array $translations): void
    {
        $content = json_encode(
            $translations,
            JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        );

        file_put_contents($filepath, $content);
    }
}
