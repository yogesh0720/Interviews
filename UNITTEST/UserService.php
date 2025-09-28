<?php
// File: UserService.php

interface UserRepositoryInterface
{
    public function find(int $id): ?array;
    public function create(array $data): int;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
}

class UserService
{
    private UserRepositoryInterface $repository;

    public function __construct(UserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getUserById(int $id): ?array
    {
        return $this->repository->find($id);
    }

    public function createUser(array $data): int
    {
        if (empty($data['name']) || empty($data['email'])) {
            throw new InvalidArgumentException("Name and Email are required");
        }
        return $this->repository->create($data);
    }

    public function updateUser(int $id, array $data): bool
    {
        if (empty($data)) {
            throw new InvalidArgumentException("Update data cannot be empty");
        }
        return $this->repository->update($id, $data);
    }

    public function deleteUser(int $id): bool
    {
        return $this->repository->delete($id);
    }
}
