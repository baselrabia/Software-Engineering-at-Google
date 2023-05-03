<?php

declare(strict_types=1);

final class Database {

    private array $transactions = [];

    private static $instance = null;

    public function put(int $transactionId, string $transactionDetails): void {
        $this->transactions[$transactionId] = $transactionDetails;
    }

    public function get(int $transactionId): ?string {
        
        if (array_key_exists($transactionId, $this->transactions)) {
            return $this->transactions[$transactionId];
        }

        return null;
    }

    public static function getInstance(): Database {
        if (self::$instance == null) {
            self::$instance = new Database();
        }

        return self::$instance;
    }
}