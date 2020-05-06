<?php

declare(strict_types=1);

namespace Webparking\LaravelMinox\Entities;

use Illuminate\Support\Collection;

class Administration extends BaseEntity
{
    /** @var string */
    protected $endpoint = 'administration';

    /** @return Collection<mixed> */
    public function index(): collection
    {
        return $this->baseIndex();
    }
}
