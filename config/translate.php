<?php

use RPWebDevelopment\LaravelTranslate\Services\Reader\JsonReader;
use RPWebDevelopment\LaravelTranslate\Services\Reader\PhpReader;
use RPWebDevelopment\LaravelTranslate\Services\Translate\DeeplTranslate;
use RPWebDevelopment\LaravelTranslate\Services\Translate\GoogleTranslate;
use RPWebDevelopment\LaravelTranslate\Services\Writer\JsonWriter;
use RPWebDevelopment\LaravelTranslate\Services\Writer\PhpWriter;

return [
    'reader' => 'php',
    'default_source' => 'en',
    'lang_directory' => base_path('resources/lang'),
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
    'readers' => [
        'php' => PhpReader::class,
        'json' => JsonReader::class,
    ],
    'writers' => [
        'php' => PhpWriter::class,
        'json' => JsonWriter::class,
    ],
];
