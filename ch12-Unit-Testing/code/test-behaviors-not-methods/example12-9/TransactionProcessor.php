<?php

declare(strict_types=1);

require_once __DIR__ . "/Transaction.php";
require_once __DIR__ . "/User.php";
require_once __DIR__ . "/Ui.php";

final class TransactionProcessor {

    private Ui $ui;

    public function __construct(Ui $ui) {
        $this->ui = $ui;
    }

    public function displayTransactionResults(User $user, Transaction $transaction): void {
        $this->ui->showMessage("You bought a " . $transaction->getItemName());
        if ($user->getBalance() < User::LOW_BALANCE_THRESHOLD) {
            $this->ui->showMessage("Warning: your balance is low!");
        }
    }
}