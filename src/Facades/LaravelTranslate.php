<?php

namespace RPWebDevelopment\LaravelTranslate\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \RPWebDevelopment\LaravelTranslate\LaravelTranslate
 */
class LaravelTranslate extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return \RPWebDevelopment\LaravelTranslate\LaravelTranslate::class;
    }
}
