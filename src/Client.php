<?php

declare(strict_types=1);

namespace Webparking\LaravelMinox;

use League\OAuth2\Client\Provider\GenericProvider;
use League\OAuth2\Client\Token\AccessTokenInterface;

class Client
{
    /** @var GenericProvider */
    private $provider;

    /** @var string */
    private $state = null;

    /** @var string */
    private $token = null;

    /** @var int */
    private $tenant = null;

    /** @var int */
    private $administration = null;

    public function connect(): self
    {
        $this->provider = new GenericProvider([
            'clientId' => config('minox.client_id'),
            'clientSecret' => config('minox.client_secret'),
            'redirectUri' => config('minox.callback_url'),
            'urlAuthorize' => config('minox.authorize_url'),
            'urlAccessToken' => config('minox.token_url'),
            'urlResourceOwnerDetails' => '',
        ]);

        return $this;
    }

    public function getProvider(): GenericProvider
    {
        if (empty($this->provider)) {
            $this->connect();
        }

        return $this->provider;
    }

    public function getAuthorizationUrl(): string
    {
        return $this->getProvider()->getAuthorizationUrl(['state' => $this->getState()]) . '&scope=' . config('minox.scope');
    }

    public function getAccessToken(string $authorizationCode): AccessTokenInterface
    {
        return $this->getProvider()->getAccessToken('authorization_code', ['code' => $authorizationCode]);
    }

    public function getState(): string
    {
        return $this->state;
    }

    public function setState(string $state): void
    {
        $this->state = $state;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getTenant(): ?int
    {
        return $this->tenant;
    }

    public function setTenant(int $tenant): void
    {
        $this->tenant = $tenant;
    }

    public function getAdministration(): ?int
    {
        return $this->administration;
    }

    public function setAdministration(int $administration): void
    {
        $this->administration = $administration;
    }
}
