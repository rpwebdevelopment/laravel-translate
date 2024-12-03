<?php

use RPWebDevelopment\LaravelTranslate\Services\Reader\JsonReader;
use RPWebDevelopment\LaravelTranslate\Services\Reader\PhpReader;
use RPWebDevelopment\LaravelTranslate\Services\Translate\DeeplTranslate;
use RPWebDevelopment\LaravelTranslate\Services\Translate\GoogleTranslate;
use RPWebDevelopment\LaravelTranslate\Services\Writer\JsonWriter;
use RPWebDevelopment\LaravelTranslate\Services\Writer\PhpWriter;

return [

    /*
    |--------------------------------------------------------------------------
    | Default Reader
    |--------------------------------------------------------------------------
    |
    | This option dictates te filetypes read from and written to in the
    | translation process.
    |
    | Supported: "php", "json"
    |
    */
    'reader' => 'php',

    /*
    |--------------------------------------------------------------------------
    | Default Language Source
    |--------------------------------------------------------------------------
    |
    | This option indicates the source directory/file translations will
    | be derived from, this can be overridden with the --source option of
    | the translation command.
    |
    */
    'default_source' => 'en_GB',

    /*
    |--------------------------------------------------------------------------
    | Language Targets
    |--------------------------------------------------------------------------
    |
    | This option sets an array of target locales for bulk updating into
    | multiple languages through a single request.
    |
    | Example: ['de_DE', 'fr_FR']
    |
    */
    'target_locales' => [],

    /*
    |--------------------------------------------------------------------------
    | Root Language Directory
    |--------------------------------------------------------------------------
    |
    | This option indicates the root directory of all language files.
    |
    */
    'lang_directory' => base_path('resources/lang'),

    /*
    |--------------------------------------------------------------------------
    | Translation Provider
    |--------------------------------------------------------------------------
    |
    | This option indicates Translation service to be used for generating
    | translated strings.
    |
    | Supported: "google", "deepl"
    |
    */
    'provider' => 'google',

    /*
    |--------------------------------------------------------------------------
    | Translation Providers
    |--------------------------------------------------------------------------
    |
    | Definitions and required configurations for available translation
    | providers.
    |
    */
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
