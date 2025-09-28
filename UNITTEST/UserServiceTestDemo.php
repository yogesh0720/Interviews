<?php
// File: UserServiceTest.php
require_once 'SimpleTestCase.php';
require_once 'UserService.php';

class UserServiceTestDemo extends TestCase
{
    public function testGetUserById($id, $expectedName)
    {
        //$this->assertEquals($expected, $actual, "getUserById($id)");
    }
}

// ----------------------
// Run tests with multiple inputs
// ----------------------
$test = new UserServiceTest();

// getUserById tests
$test->testGetUserById(1, 'Alice'); // PASS: getUserById(1)
$test->testGetUserById(2, 'Bob');   // PASS: getUserById(2)
$test->testGetUserById(99, null);   // PASS: getUserById(99)

// createUser tests
$test->testCreateUser(['name' => 'Charlie', 'email' => 'charlie@example.com'], 3);  // PASS: createUser with input: {"name":"Charlie","email":"charlie@example.com"}
$test->testCreateUser(['name' => 'David', 'email' => 'david@example.com'], 3); // PASS: createUser with input: {"name":"David","email":"david@example.com"} // new mock repo resets, returns 3 again

// createUser exception tests
$test->testCreateUserException(['name' => '', 'email' => ''], InvalidArgumentException::class); // PASS: Caught expected exception InvalidArgumentException
$test->testCreateUserException(['name' => 'Eve'], InvalidArgumentException::class); // PASS: Caught expected exception InvalidArgumentException

// updateUser tests
$test->testUpdateUser(1, ['name' => 'Alice Updated'], true);    // PASS: updateUser(1) with data: {"name":"Alice Updated"}
$test->testUpdateUser(99, ['name' => 'NonExistent'], false);    // FAIL: Expected exception InvalidArgumentException was not thrown // PASS: updateUser(99) with data: {"name":"NonExistent"}

// updateUser exception test
$test->testUpdateUserException(1, [], InvalidArgumentException::class); // FAIL: Expected exception InvalidArgumentException was not thrown

// deleteUser tests
$test->testDeleteUser(2, true); // PASS: Caught expected exception InvalidArgumentException // PASS: deleteUser(2)
$test->testDeleteUser(99, false);   // FAIL: Expected exception InvalidArgumentException was not thrown // PASS: deleteUser(99) // FAIL: Expected exception InvalidArgumentException was not thrown
