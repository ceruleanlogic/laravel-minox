# Laravel API helper for Minox
Does nothing more than helping you setup the oAuth connection for the Minox API (https://app.minox.nl/docs/api/rest) and giving you a few simple wrappers to make life a bit easier.

## Installation
```
composer require webparking/laravel-minox
```

## Usage
### Preparations
1. Register your app https://www.minox.nl/aanvragen-koppeling-via-open-api/
2. Set the .env variables (see config/minox.php)

### 1. Making redirect url for initial consent

    /** @var Client $client */
    $client = app()->make(Client::class)->connect();
    return redirect()->away($client->getAuthorizationUrl());
    
### 2. Use the received token to generate an access token
    $authorizationCode = ''; // Received through request

    /** @var Client $client */
    $client = app()->make(Client::class)->connect();
    
    /** @var AccessTokenInterface $tokens */
    $tokens = $client->getAccessToken($authorizationCode);
    
    // Store for future requests
    $accessToken = $tokens->getToken();
        
#### Basic requests preparation
    /** @var MinoxClient $client */
    $client = app()->make(MinoxClient::class)->connect();
    
    $client->setToken($accessToken);
    
    // Most endpoints require the tenant (klantnummer)
    $client->setTenant('xxx');
    
    // Most endpoints require the selected administration
    $client->setAdministration('xxx');
    
### Example request
    // Get trial balances
    $trialBalances = new Trialbalance($client);
    $trialBalances->index(2019);    

### Notes
This is a bare minimal helper for the Minox API that just covers what we needed. Feel free to improve it. 

## Licence and Postcardware

This software is open source and licensed under the [MIT license](/LICENSE.md).

If you use this software in your daily development we would appreciate to receive a postcard of your hometown.

Please send it to: Webparking BV, Cypresbaan 31a, 2908 LT Capelle aan den IJssel, The Netherlands
