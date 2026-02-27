# Changelog

All notable changes to `laravel-translate` will be documented in this file.

## [3.0.0] - 2026-02-27

Breaking change - added functionality for variable language formality
Improved AWS string replacements.

### Added
-[[FEATURE-LANGUAGE-SPECIFIC-FORMALITY]](https://github.com/rpwebdevelopment/laravel-translate/tree/feature-language-specific-formality)


## [2.1.30] - 2026-01-07

Removed `illuminate/contracts` from composer.json as not required

### Changed
-[[HOTFIX-CORRECTING-COMPOSER-JSON]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-correcting-composer-json)

## [2.0.3] - 2025-04-23

Added improvements to tag cleanup post translation

### Changed
-[[HOTFIX-IMPROVE-TAG-STRIPPING]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-improve-tag-stripping)

## [2.0.2] - 2025-01-24

Added improvements to tag cleanup post translation

### Changed
-[[HOTFIX-STRIP-DEAD-TAGS]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-strip-dead-tags)

## [2.0.1] - 2025-01-24

Changed variable handling to improve reliability

### Changed
-[[HOTFIX-IMPROVED-VARIABLE-HANDLING]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-improved-variable-handling)

## [2.0.0] - 2025-01-24

Added support for AWS Translate API

### Added
-[[FEATURE-AWS-TRANSLATE]](https://github.com/rpwebdevelopment/laravel-translate/tree/feature-aws-translate)

## [1.3.1] - 2024-12-05

Added additional DeepL configuration options for formality and translation data model

### Added
- [[FEATURE-ADDITIONAL-DEEPL-CONFIG]](https://github.com/rpwebdevelopment/laravel-translate/tree/feature-additional-deepl-config)

## [1.3.0] - 2024-12-04

Added missing translations command

### Added
- [[FEATURE-MISSING-TRANSLATIONS]](https://github.com/rpwebdevelopment/laravel-translate/tree/feature-missing-translations)

## [1.2.2] - 2024-12-03

Bugfix deployed to ensure reader resets between language runs on bulk command

### Fixed
- [[HOTFIX-MULTI-TARGET-RESET]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-multi-target-reset)

## [1.2.1] - 2024-12-03

Bugfix deployed for missing-only error when target lang file missing

### Fixed
- [[HOTFIX-MISSING-ONLY-MISSING-TARGET]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-missing-only-missing-target)

## [1.2.0] - 2024-12-03

Added new bulk translate command

### Added
- [[FEATURE-MULTI-TARGET]](https://github.com/rpwebdevelopment/laravel-translate/tree/feature-multi-target)

## [1.1.1] - 2024-11-28

Bugfix deployed for missing-only error when target array value missing

### Fixed
- [[HOTFIX-MISSING-ONLY-MISSING-ARRAY]](https://github.com/rpwebdevelopment/laravel-translate/tree/hotfix-missing-only-missing-array)

## [1.1.0] - 2024-11-28

Added ability to use `--missing-only` flag.

### Added
- [[FEATURE-MISSING-ONLY]](https://github.com/rpwebdevelopment/laravel-translate/tree/feature-missing-only)
