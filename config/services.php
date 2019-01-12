<?php

return [

    'github' => [
        'token' => env('GITHUB_TOKEN'),
        'files' => env('GITHUB_FILES'),
        'hook_secret' => env('GITHUB_HOOK_SECRET'),
        'username' => env('GITHUB_USERNAME'),
    ],

    'last-fm' => [
        'api_key' => env('LAST_FM_API_KEY'),
        'users' => explode(',', env('LAST_FM_USERS')),
    ],

    'packagist' => [
        'vendor' => env('PACKAGIST_VENDOR'),
    ],

    'todoist' => [
        'api_keys' => explode(',', env('TODOIST_TOKEN')),
        'users' => explode(',', env('TODOIST_User')),
    ],

    'open-weather-map' => [
        'api_key' => env('OPEN_WEATHER_MAP_API_KEY'),
    ]

];
