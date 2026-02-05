<?php

/**
 * Pest - Modern PHP testing framework with elegant syntax
 * 
 * WHEN TO USE:
 * - Modern PHP projects (PHP 7.3+)
 * - When you want cleaner, more readable tests
 * - Projects that prefer functional over class-based approach
 * - Teams familiar with Jest/Vitest from JavaScript
 * 
 * WHY USE:
 * - Elegant, expressive syntax
 * - Built on top of PHPUnit (same power, better DX)
 * - Parallel testing support
 * - Beautiful output and reporting
 * - Less boilerplate code
 */

// Basic test
test('calculator can add two numbers', function () {
    $calculator = new Calculator();
    $result = $calculator->add(2, 3);

    expect($result)->toBe(5);
});

// Grouped tests
describe('Calculator', function () {
    beforeEach(function () {
        $this->calculator = new Calculator();
    });

    test('addition works correctly', function () {
        expect($this->calculator->add(5, 3))->toBe(8);
    });

    test('division by zero throws exception', function () {
        expect(fn() => $this->calculator->divide(10, 0))
            ->toThrow(InvalidArgumentException::class);
    });
});

// Dataset testing (similar to PHPUnit data providers)
test('addition with datasets', function ($a, $b, $expected) {
    $calculator = new Calculator();
    expect($calculator->add($a, $b))->toBe($expected);
})->with([
    [1, 2, 3],
    [0, 0, 0],
    [-1, 1, 0],
]);

// Higher-order testing
it('can perform calculations')
    ->expect(fn() => (new Calculator())->add(2, 3))
    ->toBe(5);

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
