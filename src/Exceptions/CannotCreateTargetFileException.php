<?php

namespace RPWebDevelopment\LaravelTranslate\Exceptions;

use Exception;

class CannotCreateTargetFileException extends Exception
{
    public function __construct()
    {
        parent::__construct("Unable to create target file");
    }
}
