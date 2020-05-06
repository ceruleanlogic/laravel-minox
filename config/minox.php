<?php

declare(strict_types=1);

return [
    /*
    |--------------------------------------------------------------------------
    | To get a clientId and client secret you need to register as partner.
    |  https://www.minox.nl/aanvragen-koppeling-via-open-api/
    |--------------------------------------------------------------------------
    */
    'client_id' => env('MINOX_CLIENT_ID'),
    'client_secret' => env('MINOX_CLIENT_SECRET'),
    'callback_url' => env('MINOX_CALLBACK_URL'),

    /*
    |--------------------------------------------------------------------------
    | Default scopes as we needed them. See SCOPES.md for possibilities.
    |--------------------------------------------------------------------------
    */
    'scope' => env('MINOX_SCOPE', 'administration:read ledger_account:read report:read transaction:read'),

    /*
    |--------------------------------------------------------------------------
    | Endpoints
    |--------------------------------------------------------------------------
    */
    'authorize_url' => 'https://app.minox.nl/oauth/authorize',
    'token_url' => 'https://app.minox.nl/oauth/token',
    'api_url' => 'https://app.minox.nl/api/1',
];
