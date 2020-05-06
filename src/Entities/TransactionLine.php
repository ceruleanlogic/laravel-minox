<?php

declare(strict_types=1);

namespace Webparking\LaravelMinox\Entities;

use function GuzzleHttp\Psr7\build_query;
use Illuminate\Support\Collection;

class TransactionLine extends BaseEntity
{
    /** @var string */
    protected $endpoint = 'transaction_lines';

    /** @var bool */
    protected $useAdministration = true;

    /** @var int */
    protected $fiscalYear;

    /** @var int|null */
    protected $period = null;

    /** @return Collection<mixed> */
    public function index(int $year, int $period = null): collection
    {
        $this->setFiscalYear($year);
        $this->setPeriod($period);

        return $this->baseIndex();
    }

    public function getEndpoint(): string
    {
        return 'year/' . $this->getFiscalYear() . '/' . $this->endpoint . $this->getFilterString();
    }

    private function setFiscalYear(int $year): void
    {
        $this->fiscalYear = $year;
    }

    private function getFiscalYear(): int
    {
        if (!$this->fiscalYear) {
            throw new \RuntimeException('Fiscal year not set!');
        }

        return $this->fiscalYear;
    }

    private function setPeriod(int $period = null): void
    {
        $this->period = $period;
    }

    private function getPeriod(): ?int
    {
        return $this->period;
    }

    private function getFilterString(): string
    {
        $parts = [];

        if ($this->getPeriod()) {
            $parts['period'] = $this->getPeriod();
        }

        return '?' . build_query($parts);
    }
}
