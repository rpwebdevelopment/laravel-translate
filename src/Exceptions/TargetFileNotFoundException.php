<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Exceptions;

use Exception;

class TargetFileNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct("Target file not found - aborting");
    }
}
