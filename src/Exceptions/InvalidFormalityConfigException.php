<?php

declare(strict_types=1);

namespace RPWebDevelopment\LaravelTranslate\Exceptions;

use Exception;

class InvalidFormalityConfigException extends Exception
{
    public function __construct()
    {
        parent::__construct("Invalid formality configuration found");
    }
}
