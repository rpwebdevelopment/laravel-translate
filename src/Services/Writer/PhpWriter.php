<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Writer;

use RPWebDevelopment\LaravelTranslate\Contracts\Writer;

class PhpWriter extends Writer
{

    protected function writeToFile(string $filepath, array $translations): void
    {
        $content = "<?php\n\nreturn " . var_export($translations, true) . ';';

        file_put_contents($filepath, $content);
    }
}
