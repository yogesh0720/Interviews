<?php

/**
 * PHPStan - Static Analysis Tool for PHP
 * 
 * WHEN TO USE:
 * - Before code reviews and deployments
 * - In CI/CD pipelines
 * - During development (IDE integration)
 * - Legacy code modernization
 * 
 * WHY USE:
 * - Catches bugs without running code
 * - Enforces type safety
 * - Improves code quality
 * - Reduces runtime errors
 * - Helps with refactoring
 */

declare(strict_types=1);

class UserService
{
    private array $users = [];

    /**
     * PHPStan will analyze this method for type safety
     * @param array{id: int, name: string, email: string} $userData
     */
    public function createUser(array $userData): User
    {
        // PHPStan checks if all required keys exist
        $user = new User(
            $userData['id'],
            $userData['name'],
            $userData['email']
        );

        $this->users[] = $user;
        return $user;
    }

    /**
     * @return User|null
     */
    public function findUser(int $id): ?User
    {
        foreach ($this->users as $user) {
            if ($user->getId() === $id) {
                return $user;
            }
        }
        return null;
    }

    /**
     * PHPStan will catch if wrong type is passed
     */
    public function getUserCount(): int
    {
        return count($this->users);
    }
}

class User
{
    public function __construct(
        private int $id,
        private string $name,
        private string $email
    ) {}

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}

// Example of code that PHPStan would flag as problematic:
function problematicFunction(): void
{
    $service = new UserService();

    // PHPStan would catch this - missing required keys
    // $user = $service->createUser(['id' => 1]); // Error!

    // PHPStan would catch this - wrong type
    // $count = $service->getUserCount() + "string"; // Error!
}
