<?php

/*
    5️⃣ Repository Pattern
    ❓ When to use
    Separate business logic from database logic
    Make code testable
    ✅ Real use case
    User, Order, Product DB access
*/

interface UserRepository
{
    public function find(int $id): array;
}

class MysqlUserRepository implements UserRepository
{
    public function find(int $id): array
    {
        return ['id' => $id, 'name' => 'Yogesh'];
    }
}

class UserService
{
    private UserRepository $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function find(int $id): array
    {
        return $this->userRepository->find($id);
    }
}

// 👉 Use Repository for clean architecture
$userRepository = new MysqlUserRepository();
$userService = new UserService($userRepository);
var_dump($userService->find(1));
