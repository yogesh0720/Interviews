<?php

/**
 * PHP-CS-Fixer - Code Style Fixer
 * 
 * WHEN TO USE:
 * - Enforce consistent code style
 * - Before code reviews
 * - In CI/CD pipelines
 * - Team collaboration
 * 
 * WHY USE:
 * - Automatic code formatting
 * - PSR compliance
 * - Customizable rules
 * - IDE integration
 * - Reduces style debates
 */

use PHPUnit\Framework\TestCase;

class MathTest extends TestCase
{
    /**
     * @dataProvider calculationProvider
     */
    public function testCalculations($operation, $a, $b, $expected)
    {
        $calculator = new Calculator();

        switch ($operation) {
            case 'add':
                $result = $calculator->add($a, $b);
                break;
            case 'subtract':
                $result = $calculator->subtract($a, $b);
                break;
            case 'multiply':
                $result = $calculator->multiply($a, $b);
                break;
            default:
                $this->fail('Unknown operation');
        }

        $this->assertEquals($expected, $result);
    }

    public function calculationProvider(): array
    {
        return [
            'addition positive' => ['add', 2, 3, 5],
            'addition negative' => ['add', -1, 1, 0],
            'subtraction' => ['subtract', 5, 3, 2],
            'multiplication' => ['multiply', 4, 3, 12],
        ];
    }

    /**
     * @dataProvider validationProvider
     */
    public function testValidation($input, $expectedValid, $expectedMessage)
    {
        $validator = new Validator();
        $result = $validator->validate($input);

        $this->assertEquals($expectedValid, $result['valid']);
        $this->assertEquals($expectedMessage, $result['message']);
    }

    public function validationProvider(): array
    {
        return [
            ['valid@email.com', true, 'Valid email'],
            ['invalid-email', false, 'Invalid format'],
            ['', false, 'Empty input'],
        ];
    }
}

class Calculator
{
    public function add($a, $b)
    {
        return $a + $b;
    }

    public function subtract($a, $b)
    {
        return $a - $b;
    }

    public function multiply($a, $b)
    {
        return $a * $b;
    }
}

class Validator
{
    public function validate($input): array
    {
        if (empty($input)) {
            return ['valid' => false, 'message' => 'Empty input'];
        }

        if (filter_var($input, FILTER_VALIDATE_EMAIL)) {
            return ['valid' => true, 'message' => 'Valid email'];
        }

        return ['valid' => false, 'message' => 'Invalid format'];
    }
}
