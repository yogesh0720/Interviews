<?php
// File: UserServiceTest.php
require_once 'SimpleTestCase.php';
require_once 'UserService.php';

class UserServiceTest extends TestCase
{
    private function getMockRepo(): UserRepositoryInterface
    {
        return new class implements UserRepositoryInterface {
            private $data = [
                1 => ['id' => 1, 'name' => 'Alice', 'email' => 'alice@example.com'],
                2 => ['id' => 2, 'name' => 'Bob', 'email' => 'bob@example.com']
            ];

            public function find(int $id): ?array
            {
                return $this->data[$id] ?? null;
            }

            public function create(array $data): int
            {
                $newId = count($this->data) + 1;
                $this->data[$newId] = ['id' => $newId] + $data;
                return $newId;
            }

            public function update(int $id, array $data): bool
            {
                if (!isset($this->data[$id])) return false;
                $this->data[$id] = array_merge($this->data[$id], $data);
                return true;
            }

            public function delete(int $id): bool
            {
                if (!isset($this->data[$id])) return false;
                unset($this->data[$id]);
                return true;
            }
        };
    }

    // Test getUserById dynamically
    public function testGetUserById($id, $expectedName)
    {
        $service = new UserService($this->getMockRepo());
        $this->runTest(function ($id, $expected) use ($service) {
            $user = $service->getUserById($id);
            $actual = $user['name'] ?? null;
            $this->assertEquals($expected, $actual, "getUserById($id)");
        }, $id, $expectedName);
    }

    // Test createUser dynamically
    public function testCreateUser($inputData, $expectedId)
    {
        $service = new UserService($this->getMockRepo());
        $this->runTest(function ($data, $expected) use ($service) {
            $id = $service->createUser($data);
            $this->assertEquals($expected, $id, "createUser with input: " . json_encode($data));
        }, $inputData, $expectedId);
    }

    // Test createUser exception dynamically
    public function testCreateUserException($inputData, $expectedException)
    {
        $service = new UserService($this->getMockRepo());
        $this->expectedException = $expectedException;
        $this->runTest(function ($data) use ($service) {
            $service->createUser($data);
        }, $inputData);
    }

    // Test updateUser dynamically
    public function testUpdateUser($id, $updateData, $expectedResult)
    {
        $service = new UserService($this->getMockRepo());
        $this->runTest(function ($id, $data, $expected) use ($service) {
            $result = $service->updateUser($id, $data);
            $this->assertEquals($expected, $result, "updateUser($id) with data: " . json_encode($data));
        }, $id, $updateData, $expectedResult);
    }

    // Test updateUser exception dynamically
    public function testUpdateUserException($id, $updateData, $expectedException)
    {
        $service = new UserService($this->getMockRepo());
        $this->expectedException = $expectedException;
        $this->runTest(function ($id, $data) use ($service) {
            $service->updateUser($id, $data);
        }, $id, $updateData);
    }

    // Test deleteUser dynamically
    public function testDeleteUser($id, $expectedResult)
    {
        $service = new UserService($this->getMockRepo());
        $this->runTest(function ($id, $expected) use ($service) {
            $result = $service->deleteUser($id);
            $this->assertEquals($expected, $result, "deleteUser($id)");
        }, $id, $expectedResult);
    }
}

// ----------------------
// Run tests with multiple inputs
// ----------------------
$test = new UserServiceTest();

// getUserById tests
$test->testGetUserById(1, 'Alice');
$test->testGetUserById(2, 'Bob');
$test->testGetUserById(99, null);

// createUser tests
$test->testCreateUser(['name' => 'Charlie', 'email' => 'charlie@example.com'], 3);
$test->testCreateUser(['name' => 'David', 'email' => 'david@example.com'], 3); // new mock repo resets, returns 3 again

// createUser exception tests
$test->testCreateUserException(['name' => '', 'email' => ''], InvalidArgumentException::class);
$test->testCreateUserException(['name' => 'Eve'], InvalidArgumentException::class);

// updateUser tests
$test->testUpdateUser(1, ['name' => 'Alice Updated'], true);
$test->testUpdateUser(99, ['name' => 'NonExistent'], false);

// updateUser exception test
$test->testUpdateUserException(1, [], InvalidArgumentException::class);

// deleteUser tests
$test->testDeleteUser(2, true);
$test->testDeleteUser(99, false);



// PASS: getUserById(1)
// PASS: getUserById(2)
// PASS: getUserById(99)
// PASS: createUser with input: {"name":"Charlie","email":"charlie@example.com"}
// PASS: createUser with input: {"name":"David","email":"david@example.com"}
// PASS: Caught expected exception InvalidArgumentException
// PASS: Caught expected exception InvalidArgumentException
// PASS: updateUser(1) with data: {"name":"Alice Updated"}
// FAIL: Expected exception InvalidArgumentException was not thrown
// PASS: updateUser(99) with data: {"name":"NonExistent"}
// FAIL: Expected exception InvalidArgumentException was not thrown
// PASS: Caught expected exception InvalidArgumentException
// PASS: deleteUser(2)
// FAIL: Expected exception InvalidArgumentException was not thrown
// PASS: deleteUser(99)
// FAIL: Expected exception InvalidArgumentException was not thrown