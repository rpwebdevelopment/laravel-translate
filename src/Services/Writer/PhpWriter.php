<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Services\Writer;

use RPWebDevelopment\LaravelTranslate\Contracts\Writer;
use Symfony\Component\VarExporter\VarExporter;

class PhpWriter extends Writer
{

    protected function writeToFile(string $filepath, array $translations): void
    {
        $content = "<?php\n\nreturn " . VarExporter::export($translations) . ';\n';

        file_put_contents($filepath, $content);
    }
}
