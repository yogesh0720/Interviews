<?php

use Behat\Behat\Context\Context;
use PHPUnit\Framework\Assert;

/**
 * Behat Context - Implements the steps defined in feature files
 */
class CalculatorContext implements Context
{
    private $calculator;
    private $result;

    /**
     * @Given I have a calculator
     */
    public function iHaveACalculator()
    {
        $this->calculator = new Calculator();
    }

    /**
     * @When I add :first and :second
     */
    public function iAddAnd($first, $second)
    {
        $this->result = $this->calculator->add((int)$first, (int)$second);
    }

    /**
     * @Then the result should be :expected
     */
    public function theResultShouldBe($expected)
    {
        Assert::assertEquals((int)$expected, $this->result);
    }
}

// Simple Calculator class for demonstration
class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}
