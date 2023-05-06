<?php

declare(strict_types=1);

final class User {

    private float|int $balance;
    public const LOW_BALANCE_THRESHOLD = 1;

    public function __construct(float|int $balance = self::LOW_BALANCE_THRESHOLD) {
        $this->balance = $balance;
    }

    public function getBalance(): float|int {
        return $this->balance;
    }

}