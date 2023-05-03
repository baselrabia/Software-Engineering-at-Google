<?php

declare(strict_types=1);

require_once __DIR__ . "/../TransactionProcessor.php";
require_once __DIR__ . "/../Transaction.php";
require_once __DIR__ . "/../User.php";
require_once __DIR__ . "/../Ui.php";

use PHPUnit\Framework\TestCase;

final class Test extends TestCase
{


    /** @test */
    public function displayTransactionResults_showsItemName(): void
    {

        // Given a ui object
        $ui = new Ui();

        // And a transaction processor object
        $transactionProcessor = new TransactionProcessor($ui);

        // And a user with balance equal LOW_THRESHOLD_BALANCE which is 1
        $user = new User();

        // And a transaction with price equal 1
        $transaction = new Transaction(itemName: "Some Item");

        // When display transaction results to ui
        $transactionProcessor->displayTransactionResults(
            user: $user,
            transaction: $transaction
        );

        // Then the transaction is done and "You bought a Some Item" should be in ui
        $this->assertStringContainsString(
            "You bought a Some Item", $ui->getText(),
            "Expected UI message contain 'You bought a Some Item'"
        );
    }

    /** @test */
    public function displayTransactionResults_showsLowBalanceWarning(): void
    {
        // Given a ui object
        $ui = new Ui();

        // And a transaction processor object
        $transactionProcessor = new TransactionProcessor($ui);

        // And a user with balance equal 0
        $user = new User(balance: 0);

        // And a transaction with price equal 2
        $transaction = new Transaction(itemName: "Some Item", price: 2);

        // When display transaction results to ui
        $transactionProcessor->displayTransactionResults(
            user: $user,
            transaction: $transaction
        );

        // Then "your balance is low" should be printed in ui
        $this->assertStringContainsString(
            "your balance is low", $ui->getText(),
            "Expected UI message contain 'your balance is low'"
        );
    }

}