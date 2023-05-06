<?php

declare(strict_types=1);

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/Transaction.php';

final class TransactionAPI
{

    private Database $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }


    public function processTransaction(Transaction $transaction): void
    {
        if ($this->isValid($transaction)) {
            $this->saveToDatabase($transaction);
        }
    }

    public function isValid(Transaction $transaction): bool
    {
        return $transaction->getAmount() < $transaction->getSender()->getBalance();
    }

    public function saveToDatabase(Transaction $transaction): void
    {
        $s = $transaction->getSender()->getName() . "," .
            $transaction->getRecipient()->getName() . "," .
            $transaction->getAmount();

        $this->database->put($transaction->getId(), $s);
    }

}