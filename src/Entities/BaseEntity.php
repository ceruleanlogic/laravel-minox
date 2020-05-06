<?php

declare(strict_types=1);

namespace Webparking\LaravelMinox\Entities;

use Illuminate\Support\Collection;
use Webparking\LaravelMinox\Client;

abstract class BaseEntity
{
    /** @var Client */
    protected $client;

    /** @var string */
    protected $endpoint;

    /** @var bool */
    protected $useAdministration = false;

    public function __construct(Client $client)
    {
        $this->client = $client;
    }

    /** @return Collection<mixed> */
    protected function baseIndex(): collection
    {
        $request = $this->client->getProvider()->getAuthenticatedRequest(
            'GET',
            $this->buildUri(),
            $this->client->getToken()
        );

        $json = json_decode($this->client->getProvider()->getResponse($request)->getBody()->getContents());

        if (isset($json->collection)) {
            return collect(array_values($json->collection));
        }

        return collect($json);
    }

    private function buildUri(): string
    {
        $url = implode(
            '/',
            array_filter(
                [
                    config('minox.api_url'),
                    $this->getTenant(),
                    $this->getAdministration(),
                    $this->getEndpoint(),
                ]
            )
        );

        return $url;
    }

    public function getEndpoint(): string
    {
        if (null === $this->endpoint) {
            throw new \RuntimeException('Endpoint not set!');
        }

        return $this->endpoint;
    }

    private function getTenant(): string
    {
        if (null === $this->client->getTenant()) {
            throw new \RuntimeException('Tenant not set!');
        }

        return 'tenant/' . $this->client->getTenant();
    }

    private function getAdministration(): ?string
    {
        if (!$this->useAdministration) {
            return null;
        }

        return 'administration/' . $this->client->getAdministration();
    }
}
