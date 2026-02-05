<?php

use PHPUnit\Framework\TestCase;

/**
 * PHPUnit - The most popular PHP testing framework
 * 
 * WHEN TO USE:
 * - Unit testing individual classes/methods
 * - Integration testing
 * - Test-driven development (TDD)
 * - Continuous integration pipelines
 * 
 * WHY USE:
 * - Industry standard with extensive documentation
 * - Rich assertion library
 * - Mocking capabilities
 * - Code coverage reports
 * - IDE integration
 */
class CalculatorTest extends TestCase
{
    private $calculator;

    // Setup before each test
    protected function setUp(): void
    {
        $this->calculator = new Calculator();
    }

    // Basic assertion test
    public function testAddition()
    {
        $result = $this->calculator->add(2, 3);
        $this->assertEquals(5, $result, 'Addition should work correctly');
    }

    // Testing exceptions
    public function testDivisionByZero()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->calculator->divide(10, 0);
    }

    // Data provider for multiple test cases
    /**
     * @dataProvider additionProvider
     */
    public function testAdditionWithDataProvider($a, $b, $expected)
    {
        $this->assertEquals($expected, $this->calculator->add($a, $b));
    }

    public function additionProvider()
    {
        return [
            [1, 2, 3],
            [0, 0, 0],
            [-1, 1, 0],
        ];
    }
}

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function divide($a, $b)
    {
        if ($b === 0) {
            throw new InvalidArgumentException('Division by zero');
        }
        return $a / $b;
    }
}
