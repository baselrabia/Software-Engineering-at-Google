<?php

declare(strict_types=1);

final class Account {

    private string $accountName;
    private float $balance;

    public function __construct(string $accountName, float|int $balance) {
        $this->accountName = $accountName;
        $this->balance = $balance;
    }

    public function getBalance(): float {
        return $this->balance;
    }

    public function getName(): string
    {
        return $this->accountName;
    }

    public function setBalance($balance): void {
        $this->balance = $balance;
    }
}