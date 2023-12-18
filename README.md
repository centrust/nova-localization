# Laravel Nova Inline Arabic Localization (Translation)

[![Latest Version on Packagist](https://img.shields.io/packagist/v/centrust/nova-localization.svg?style=flat-square)](https://packagist.org/packages/centrust/nova-localization)
[![GitHub Tests Action Status](https://img.shields.io/github/actions/workflow/status/centrust/nova-localization/run-tests.yml?branch=main&label=tests&style=flat-square)](https://github.com/centrust/nova-localization/actions?query=workflow%3Arun-tests+branch%3Amain)
[![GitHub Code Style Action Status](https://img.shields.io/github/actions/workflow/status/centrust/nova-localization/fix-php-code-style-issues.yml?branch=main&label=code%20style&style=flat-square)](https://github.com/centrust/nova-localization/actions?query=workflow%3A"Fix+PHP+code+style+issues"+branch%3Amain)
[![Total Downloads](https://img.shields.io/packagist/dt/centrust/nova-localization.svg?style=flat-square)](https://packagist.org/packages/centrust/nova-localization)



This package is tailored for developers using Laravel Nova who need an easy, reliable solution for managing their application's translations.
### Currently Only Supports English and Arabic languages.You are free to fork and add your own language support.


## Features

- **Inline Translation**: Automatically translates your application's text from the dashboard.
- **Flexibility**: Designed to work seamlessly with Laravel's built-in localization functionality.
- **Easiness**: An easy configuration process ensures you can start using instantly.




## Example Use
 in Nova Resource
```php
  Text::make(_tran('Name'), 'name'),
  Text::make(_tran('Description'), 'description')
```
Result
 - ِِArabic  الأسم
 - English  Name

- ِِArabic  التعريف
- English  Description


## Installation

You can install the package via composer:

```bash
composer require centrust/nova-localization
```

You can publish and run the migrations with:

```bash
php artisan vendor:publish --tag="nova-localization-migrations"
php artisan migrate
```

> Once you Migrate the table, you need to add 'locale' column to your User Model  fillable array.

You can publish the config file with:

```bash
php artisan vendor:publish --tag="nova-localization-config"
```

This is the contents of the published config file:

```php
return [
  /** 
     * If set to true, this will enable caching for localization. The actual value for this translation is taken from the server's cache.
     * If the LOCALIZATION_ENABLE_CACHE environment variable does not exist, the default value will be false.
     * This is useful for improving the application's performance by caching localizations,
     * but it might delay the appearance of any changes made to localization files until the cache is refreshed.
     **/
    'localization_enable_cache' => env('LOCALIZATION_ENABLE_CACHE', false),
    
    /**
     * This URL is for loading the Arabic font from Google Fonts.
     * This font is needed for Arabic language support in your application.
     **/
    'ar_google_font_url'=> 'https://fonts.googleapis.com/css2?family=Scheherazade+New:wght@700&display=swap',


    /**
     * This is the path to the CSS file that contains the Arabic font family.   
     * example : 'css/rtl-ar.css'
     * The file must be in the public folder.
     * This font is needed for Arabic language support in your application.
     */
    'ar_font_family_css'=> 'css/rtl-ar.css',

];
```

## Usage

#### To translate any text in your application, you can use the _tran() helepr function:
```php

_tran('This is a label');

```

```

To show the Localization Resource in the menu, (I havent figured out how to show it automatically yet)
but you can add it manually by Creating your own normal resource and extend this package resource
```php

use Centrust\NovaLocalization\Nova\NovaLocalizationResource;

class Localization extends NovaLocalizationResource
{

}

````





## How It works
- When you use the _tran() function, which is a global helper function, available in all your application's files,
- the package will search for the translation in the database,
- if it does not find it, it will search for it in the Laravel language files.
- If it does not find it in the language files, it will save it in the database and return it to you.

## Testing

```bash
composer test
```

## Changelog

Please see [CHANGELOG](CHANGELOG.md) for more information on what has changed recently.

## Contributing

Please see [CONTRIBUTING](CONTRIBUTING.md) for details.

## Security Vulnerabilities

Please review [our security policy](../../security/policy) on how to report security vulnerabilities.

## Credits

- [Salah Elabbar](https://github.com/centrust)
- [All Contributors](../../contributors)

## License

The MIT License (MIT). Please see [License File](LICENSE.md) for more information.
