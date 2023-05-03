<?php

declare(strict_types=1);

require_once __DIR__ . "/Operation.php";


final class Calculation {

    private int|float $firstOperand;
    private Operation $operation;
    private int|float $secondOperand;

    public function __construct($firstOp, $op, $secondOp) {
        $this->firstOperand = $firstOp;
        $this->operation = $op;
        $this->secondOperand = $secondOp;
    }

    public function execute(): float|int|null {

        switch ($this->operation) {
            case Operation::PLUS:
                return $this->firstOperand + $this->secondOperand;

            case Operation::MINUS:
                return $this->firstOperand - $this->secondOperand;

            default:
                return null;
        }

    }
}