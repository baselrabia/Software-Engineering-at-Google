<?php

declare(strict_types=1);

require_once __DIR__ . "/../Calculator.php";
require_once __DIR__ . "/../Operation.php";

use PHPUnit\Framework\TestCase;

final class Test extends TestCase
{

    /** @test */
    public function shouldPerformAddition(): void
    {

        // Given that calculator object
        $calculator = new Calculator();

        // And a calculation that makes a addition operation to 2 and 3
        $calculation = new Calculation(2, Operation::PLUS, 3);

        // When perform the calculation
        $result = $calculator->calculate($calculation);

        // Then the result should be 5
        $this->assertEquals($result, 5, "Expected result of 5, but got " . $result);
    }
}