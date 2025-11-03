<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Localization URL Style
    |--------------------------------------------------------------------------
    |
    | This option controls how the language parameter is added to URLs.
    |
    | Supported: "query", "suffix"
    |
    | query:  http://127.0.0.1:8001/login?lang=en
    | suffix: http://127.0.0.1:8001/login/en
    |
    */

    'url_style' => 'suffix', // 'query' or 'suffix or db/single'

    'supported_locales' => ['en', 'bn', 'es', 'fr'],

    'fallback_locale' => 'en',

];
