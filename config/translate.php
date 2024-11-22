<?php

use RPWebDevelopment\LaravelTranslate\Services\Reader\JsonReader;
use RPWebDevelopment\LaravelTranslate\Services\Reader\PhpReader;
use RPWebDevelopment\LaravelTranslate\Services\Translate\DeeplTranslate;
use RPWebDevelopment\LaravelTranslate\Services\Translate\GoogleTranslate;

return [
    'provider' => 'google',
    'providers' => [
        'google' => [
            'package' => GoogleTranslate::class,
        ],
        'deepl' => [
            'package' => DeeplTranslate::class,
            'token' => env('DEEPL_AUTH_TOKEN', null),
        ],
    ],
    'reader' => 'php',
    'readers' => [
        'php' => PhpReader::class,
        'json' => JsonReader::class,
    ],
    'lang_directory' => base_path('resources/lang'),
];
