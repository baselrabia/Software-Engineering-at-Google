<?php

declare(strict_types=1);

require_once __DIR__ . "/../TransactionAPI.php";
require_once __DIR__ . "/../Transaction.php";
require_once __DIR__ . "/../Account.php";
require_once __DIR__ . "/../Database.php";


use PHPUnit\Framework\TestCase;

// Example 12-3. Testing the public API

final class Test extends TestCase
{


    /** @test */
    public function shouldTransferFunds(): void
    {
        // Given a TransactionAPI as processor object
        $processor = new TransactionAPI();

        // And two accounts, one sender and another recipient
        $senderAccount = new Account("me", 150);
        $recipientAccount = new Account("you", 20);

        // And a transaction with the sender account, recipient account and the amount
        $transaction = (new Transaction())
            ->setSender($senderAccount)
            ->setRecipient($recipientAccount)
            ->setAmount(100);

        // When saving the accounts in DB
        $processor->setAccountBalance($senderAccount);
        $processor->setAccountBalance($recipientAccount);

        // And processing the transaction
        $processor->processTransaction($transaction);

        // Then the sender account balance should decrease by transaction amount (100) 
        $this->assertEquals(
            $processor->getAccountBalance("me"),
            50,
            "Expected account balance to be 50"
        );

        // And the recipient account balance should increase by the transaction amount (100)
        $this->assertEquals(
            $processor->getAccountBalance("you"),
            120,
            "Expected account balance to be 120"
        );
    }


    /** @test */
    public function shouldNotPerformInvalidTransactions(): void
    {
        // Given the TransactionAPI as processor object
        $processor = new TransactionAPI();

        // And two accounts, one sender with balance less than transaction amount and recipient account
        $senderAccount = new Account("me", 50);
        $recipientAccount = new Account("you", 20);

        // And a transaction with the sender account, recipient account and the amount
        $transaction = (new Transaction())
            ->setSender($senderAccount)
            ->setRecipient($recipientAccount)
            ->setAmount(100);

        // When saving the accounts in DB
        $processor->setAccountBalance($senderAccount);
        $processor->setAccountBalance($recipientAccount);

        // And processing the transaction
        $processor->processTransaction($transaction);

        // Then the sender balance should not decrease, because it is invalid transaction
        $this->assertEquals(
            $processor->getAccountBalance("me"),
            50,
            "Expected account balance to be 50 the same as before process the transaction"
        );

        // And the recipient balance should be the same.
        $this->assertEquals(
            $processor->getAccountBalance("you"),
            20,
            "Expected account balance to be 20 the same as before process the transaction"
        );
    }


}