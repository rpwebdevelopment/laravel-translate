# Package for generating translated lang files

[![Latest Version on Packagist](https://img.shields.io/packagist/v/rpwebdevelopment/laravel-translate.svg?style=flat-square)](https://packagist.org/packages/rpwebdevelopment/laravel-translate)
[![Total Downloads](https://img.shields.io/packagist/dt/rpwebdevelopment/laravel-translate.svg?style=flat-square)](https://packagist.org/packages/rpwebdevelopment/laravel-translate)

Laravel Translate is a tool intended to automatically generate translated language files. Currently, the package
leverages either [DeepL API](https://github.com/DeepLcom/deepl-php) or the amazing 
[Google Translate](https://github.com/Stichoza/google-translate-php) package 
from [Stichoza](https://github.com/Stichoza) which allows for zero configuration usage.

The default configuration makes use of Google translations and can be used straight out of the box with no sign-up 
or configuration. If you would rather use the DeepL translations API you will need to sign up 
[here](https://www.deepl.com/en/pro#developer); DeepL configuration details described below.

## Installation

You can install the package via composer:

```bash
composer require rpwebdevelopment/laravel-translate
```

You can publish the config file with:

```bash
php artisan vendor:publish --tag="translate-config"
```

This is the contents of the published config file:

```php
return [
    'reader' => 'php',
    'default_source' => 'en_GB',
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
```
## DeepL Configuration

In order to make use of the DeepL API wou will need to publish the config file as detailed above
and update the provider to `deepl`. You will then need to add your DeepL API auth token to your
`.env` file under the env variable `DEEPL_AUTH_TOKEN`.

## Usage

This package is designed to function with as much flexibility as possible, as such it is designed
to work for multiple configurations with minimal configurations, whether you have a single file or 
directory per language, or if you are using PHP lang files or JSON lang files.

```php
php artisan laravel-translate {target} {--source=?} {--file=?}
```

## Example Usages

### Directory Structure:

Example directory structure:

```bash
resources 
|----lang
     |----en_GB
          |----auth.php
          |----global.php

```

Assuming the config `default_source` is set to `en_GB`; for the above structure the following command:

```php
php artisan laravel-translate fr_FR
```
Would produce the following structure:

```bash
resources 
|----lang
     |----en_GB
     |    |----auth.php
     |    |----global.php
     |----fr_FR
          |----auth.php
          |----global.php

```

Alternately, you can explicitly declare the source locale:

```php
php artisan laravel-translate fr_FR --source=en_GB
```

If you are only wanting to replace a specific file you can also pass in the file option (note the file extension is optional):

```php
php artisan laravel-translate fr_FR --source=en_GB --file=auth
```
 
### Single File Structure

If you are using a single file per language rather than a directory structure as below:

```bash
resources 
|----lang
     |----en_GB.php
     |----fr_FR.php

```

You can use the exact same command syntax, so the following:

```php
php artisan laravel-translate de_DE --source=en_GB
```

Would result in the following output:
```bash
resources 
|----lang
     |----en_GB.php
     |----fr_FR.php
     |----de_DE.php

```

## Notes

- Any existing translations will be overridden, it is recommended that you back-up any previously 
created lang files to allow for easy restoration if required.

- Translations are a result of machine translation and therefore some translation errors may occur.

- While efforts have been made to persist lang string attributes, their persistence cannot be 100%
guaranteed, as such it is recommended to verify your files after production. 

## Credits

- [Richard Porter](https://github.com/rpwebdevelopment)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
