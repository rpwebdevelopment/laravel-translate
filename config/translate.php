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

            /*
            |--------------------------------------------------------------------------
            | DeepL Formality
            |--------------------------------------------------------------------------
            |
            | @see https://developers.deepl.com/docs/api-reference/translate
            |
            | Supported: "less", "more", "default", "prefer_less", "prefer_more"
            */
            'formality' => 'default',
        ],
        'aws' => [
            'package' => AwsTranslate::class,
            'credentials' => [
                'key' => env('AWS_ACCESS_KEY_ID', null),
                'secret' => env('AWS_SECRET_ACCESS_KEY', null),
            ],
            'settings' => [
                /*
                |--------------------------------------------------------------------------
                | AWS Formality
                |--------------------------------------------------------------------------
                |
                | @see https://docs.aws.amazon.com/aws-sdk-php/v3/api/api-translate-2017-07-01.html#shape-translationsettings
                |
                | Supported: "FORMAL", "INFORMAL"
                */
                "Formality" => "FORMAL"
            ],
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
