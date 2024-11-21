<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Illuminate\Console\Command;
use RPWebDevelopment\LaravelTranslate\Facades\Translate;

class LaravelTranslateCommand extends Command
{
    public $signature = 'laravel-translate';

    public $description = 'My command';

    public function handle(): int
    {
        $test = Translate::translate('testing setup', 'fr');

        $this->comment($test);
        $this->comment('All done');

        return self::SUCCESS;
    }
}
