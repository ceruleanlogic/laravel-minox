<?php

declare(strict_types=1);

namespace Webparking\LaravelMinox\Entities;

use Illuminate\Support\Collection;

class Ledger extends BaseEntity
{
    /** @var string */
    protected $endpoint = 'ledger_account';

    /** @var bool */
    protected $useAdministration = true;

    /** @return Collection<mixed> */
    public function index(): collection
    {
        return $this->baseIndex();
    }
}
