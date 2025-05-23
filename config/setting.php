<?php

return [

    'app_name' => [
        'type' => 'text',
        'max' => 255,
        'default_value' => 'My Application'
    ],

    'currencies' => [
        'type' => 'array',
          'default_value' => [
              'KWD',
          ],
    ],

    'default_currency' => [
        'type' => 'text',
        'max' => 255,
        'default_value' => 'KWD'
    ],

    'countries' => [
        'type' => 'array',
          'default_value' => [
              'KW',
          ],
    ],

    'default_country' => [
        'type' => 'text',
        'max' => 255,
        'default_value' => 'KW'
    ],

    'locales' => [
        'type' => 'array',
          'default_value' => [
              'en',
          ],
    ],

    'default_lang' => [
        'type' => 'text',
        'max' => 255,
        'default_value' => 'en'
    ],

    'default_shipping' => [
        'type' => 'number',
        'max' => 255,
        'default_value' => 0.000
    ],

    'phone_number' => [
        'type' => 'text',
        'max' => 255,
        'default_value' => '+9651232334'
    ],

    'version' => '1.0.0',
    'user_limit' => 10,
];
