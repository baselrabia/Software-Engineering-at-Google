<?php

declare(strict_types=1);

require_once __DIR__ . "/../TransactionAPI.php";
require_once __DIR__ . "/../Transaction.php";
require_once __DIR__ . "/../Account.php";
require_once __DIR__ . "/../Database.php";


use PHPUnit\Framework\TestCase;

// Example 12-2. A naive test of a transaction API’s implementation

final class Test1 extends TestCase
{


    /** @test */
    public function emptyAccountShouldNotBeValid(): void
    {

        // Given the TransactionApI as processor object
        $processor = new TransactionAPI();

        // And a transaction with an account that sends it with 0 balance
        $transaction = (new Transaction())->setSender(new Account("", 0));

        // When the amount of transaction is greater than Sender account balance
        $isValid = $processor->isValid($transaction);

        // Then the transaction is not valid
        $this->assertFalse($isValid, "Empty Account Should Not Be Valid");
    }

    /** @test */
    public function shouldSaveSerializedData()
    {
        // Given the TransactionApI as processor object
        $processor = new TransactionAPI();

        // And a database instance
        $database = Database::getInstance();

        // And a transaction with these details
        $transaction = (new Transaction())
            ->setId(123)
            ->setSender(new Account("me", 100))
            ->setRecipient(new Account("you", 100))
            ->setAmount(100);

        // When saving the transaction in DB.
        $processor->saveToDatabase($transaction);

        // Then the transaction should be serialized and saved in DB.        
        $this->assertSame(
            $database->get(123),
            "me,you,100",
            "Transaction is expected to be saved as serialized data in DB,
          but transaction not found in DB"
        );
    }
}