<?php

use RPWebDevelopment\LaravelTranslate\Services\DeeplTranslate;
use RPWebDevelopment\LaravelTranslate\Services\GoogleTranslate;

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
    ]
];
