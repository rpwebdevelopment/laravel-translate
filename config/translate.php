<?php

use RPWebDevelopment\LaravelTranslate\Services\Reader\JsonReader;
use RPWebDevelopment\LaravelTranslate\Services\Reader\PhpReader;
use RPWebDevelopment\LaravelTranslate\Services\Translate\AwsTranslate;
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
    | multiple languages through a single request. The format required is
    | array key as the lang filename with target lang and optional formality
    | values. Note: formality has no effect on the Google provider.
    |
    | Formality options are 'more_formal', 'less_formal', default is 'more_formal'
    |
    | Example: [
    |     'de_DE_formal' => ['lang' => 'de_DE'],
    |     'de_DE_casual' => ['lang' => 'de_DE', 'formality' => less_formal],
    | ]
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
    | Supported: "google", "deepl", "aws"
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

            /*
            |--------------------------------------------------------------------------
            | DeepL Model Type
            |--------------------------------------------------------------------------
            |
            | @see https://developers.deepl.com/docs/api-reference/translate
            |
            | Supported: "quality_optimized", "prefer_quality_optimized",
            | "latency_optimized"
            */
            'model_type' => 'prefer_quality_optimized',
        ],
        'aws' => [
            'package' => AwsTranslate::class,
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID', null),
                'secret' => env('AWS_SECRET_ACCESS_KEY', null),
            ],
            'settings' => [],
            "region" => env('AWS_DEFAULT_REGION', "us-east-1"),
            "version" => "latest",
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
