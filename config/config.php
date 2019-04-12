<?php

return [
    /*
    |--------------------------------------------------------------------------
    | FlightDeck Authorization
    |--------------------------------------------------------------------------
    |
    | Enabling authorization (not to be confused with authentication), allows
    | your API to control who can access your API without the need of
    | using a traditional auth system with usernames and passwords
    |
    */
    'authorization' => [
        'enabled' => true,
        'header' => 'X-Authorization',
    ],

    /*
    |--------------------------------------------------------------------------
    | FlightDeck Authentication
    |--------------------------------------------------------------------------
    |
    | Enabling authentication adds routes for login, password resetting
    | and registration. By default we use JWT
    |
    */
    'authentication' => [
        'enabled' => true,
    ],

    'tokens' => [
        'expire_days' => 30,
    ],

    /*
    |--------------------------------------------------------------------------
    | Cross-Origin Resource Sharing (CORS)
    |--------------------------------------------------------------------------
    |
    | If you consume your API from a different domain, you will need to
    | enable CORS to be able to access it
    |
    */
    'cors' => [
        'enabled' => true,
    ],
];
