<?php

// config for Centrust/NovaLocalization
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
