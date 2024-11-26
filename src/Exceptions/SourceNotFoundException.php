<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Exceptions;

use Exception;

class SourceNotFoundException extends Exception
{
    public function __construct()
    {
        parent::__construct('Unable to locate source file');
    }
}
