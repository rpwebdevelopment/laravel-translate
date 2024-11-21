<?php

namespace RPWebDevelopment\LaravelTranslate\Commands;

use Illuminate\Console\Command;

class LaravelTranslateCommand extends Command
{
    public $signature = 'laravel-translate';

    public $description = 'My command';

    public function handle(): int
    {
        $this->comment('All done');

        return self::SUCCESS;
    }
}
