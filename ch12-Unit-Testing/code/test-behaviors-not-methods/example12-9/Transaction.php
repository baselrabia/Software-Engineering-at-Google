<?php

declare(strict_types=1);

final class Transaction {

    private string $itemName;
    private float|int $price;

    public function __construct(string $itemName, float|int $price = 1) {
        $this->itemName = $itemName;
        $this->price = $price;
    }

    public function getItemName(): string {
        return $this->itemName;
    }

    public function getPrice(): float|int {
        return $this->price;
    }
}