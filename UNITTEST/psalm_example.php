<?php

/**
 * Psalm - Advanced Static Analysis Tool for PHP
 * 
 * WHEN TO USE:
 * - Type safety enforcement
 * - Finding complex type-related bugs
 * - Gradual typing adoption
 * - Template/generic type checking
 * - Taint analysis for security
 * 
 * WHY USE:
 * - More advanced than PHPStan in some areas
 * - Better template/generic support
 * - Taint analysis for security vulnerabilities
 * - Gradual typing with baseline
 * - Excellent IDE integration
 */

declare(strict_types=1);

/**
 * @template T
 */
class Repository
{
    /** @var array<T> */
    private array $items = [];

    /**
     * @param T $item
     */
    public function add($item): void
    {
        $this->items[] = $item;
    }

    /**
     * @return T|null
     */
    public function findById(int $id)
    {
        return $this->items[$id] ?? null;
    }

    /**
     * @return array<T>
     */
    public function getAll(): array
    {
        return $this->items;
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

class UserService
{
    /** @var Repository<User> */
    private Repository $userRepository;

    public function __construct()
    {
        $this->userRepository = new Repository();
    }

    /**
     * @psalm-taint-source input
     */
    public function createUserFromInput(string $name, string $email): User
    {
        // Psalm will track taint flow for security analysis
        $user = new User(
            random_int(1, 1000),
            $name,
            $email
        );

        $this->userRepository->add($user);
        return $user;
    }

    /**
     * @psalm-assert-if-true !null $user
     */
    public function isValidUser(?User $user): bool
    {
        return $user !== null && !empty($user->getName());
    }

    /**
     * Psalm will ensure type safety with nullable returns
     */
    public function processUser(int $id): string
    {
        $user = $this->userRepository->findById($id);

        if ($this->isValidUser($user)) {
            // Psalm knows $user is not null here due to assertion
            return "Processing user: " . $user->getName();
        }

        return "User not found";
    }
}

/**
 * @psalm-immutable
 */
class ImmutableValue
{
    public function __construct(
        public readonly string $value
    ) {}
}

// Psalm will catch type errors that PHPStan might miss
function demonstratePsalmFeatures(): void
{
    $service = new UserService();

    // Psalm tracks taint from user input
    $userInput = $_GET['name'] ?? 'default';
    $user = $service->createUserFromInput($userInput, 'test@example.com');

    // Psalm ensures type consistency
    $result = $service->processUser($user->getId());
    echo $result;
}
