<?php
class TestCase
{
    protected $expectedException = null;

    public function assertEquals($expected, $actual, $message = '')
    {
        echo ($expected === $actual) ? "PASS: $message\n" : "FAIL: $message (Expected $expected, got $actual)\n";
    }

    public function assertTrue($condition, $message = '')
    {
        $this->assertEquals(true, $condition, $message);
    }

    public function assertFalse($condition, $message = '')
    {
        $this->assertEquals(false, $condition, $message);
    }

    public function expectException($exceptionClass)
    {
        $this->expectedException = $exceptionClass;
    }

    public function runTest(callable $callback, ...$params)
    {
        if ($this->expectedException) {
            try {
                $callback(...$params);
                echo "FAIL: Expected exception {$this->expectedException} was not thrown\n";
            } catch (Exception $e) {
                echo (get_class($e) === $this->expectedException)
                    ? "PASS: Caught expected exception {$this->expectedException}\n"
                    : "FAIL: Unexpected exception: " . get_class($e) . "\n";
            }
        } else {
            $callback(...$params);
        }
    }
}
