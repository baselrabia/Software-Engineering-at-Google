<?php

declare(strict_types=1);

final class Database {

    private array $transactions = [];
    private array $accounts = [];

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

    public function setAccount(Account $account): void {
        $this->accounts[$account->getName()] = $account;
    }

    public function getAccount(string $accountName): ?Account {
        if (array_key_exists($accountName, $this->accounts)) {
            return $this->accounts[$accountName];
        }

        return null;
    }

    public function process(Transaction $transaction) {
        // subtract amount of transaction from sender
        $senderAccount = $this->accounts[$transaction->getSender()->getName()];
        $senderAccount->setBalance($senderAccount->getBalance() - $transaction->getAmount());
        
        // add amount of transaction to recipient
        $recipientAccount = $this->accounts[$transaction->getRecipient()->getName()];
        $recipientAccount->setBalance($recipientAccount->getBalance() + $transaction->getAmount());
    }
}