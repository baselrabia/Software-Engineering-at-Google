<?php

declare(strict_types=1);

require_once __DIR__ . "/Calculation.php";

final class Calculator {

    public function calculate(Calculation $cal) : int|float|null {
        return $cal->execute();
    }

}