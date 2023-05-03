<?php

declare(strict_types=1);

require_once __DIR__ . "/../TransactionProcessor.php";
require_once __DIR__ . "/../Transaction.php";
require_once __DIR__ . "/../User.php";
require_once __DIR__ . "/../Ui.php";

use PHPUnit\Framework\TestCase;

final class Test extends TestCase {


    /** @test */
    public function testDisplayTransactionResults(): void {
        $ui = Ui::getInstance();
        $transactionProcessor = new TransactionProcessor($ui);
        $transactionProcessor->displayTransactionResults(
            new User(User::LOW_BALANCE_THRESHOLD + 2),
            new Transaction("Some Item", 3)
        );

        $this->assertStringContainsString("You bought a Some Item", $ui->getText());
        $this->assertStringContainsString("your balance is low", $ui->getText());
    }
}