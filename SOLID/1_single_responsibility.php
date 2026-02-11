<?php

/**
 * S – Single Responsibility Principle (SRP)
 * 
 * WHEN TO USE:
 * - When a class starts handling multiple concerns
 * - Business logic + persistence + communication mixed together
 * 
 * WHY TO USE:
 * - Makes code easier to understand, test, and modify
 * - Prevents side effects when making changes
 * - Each class has one reason to change
 */

// ❌ BAD: Multiple responsibilities in one class
class UserBad
{
    public function saveToDatabase()
    {
        echo "Saving user to database\n";
    }

    public function sendEmail()
    {
        echo "Sending email\n";
    }
}

// ✅ GOOD: Each class has single responsibility
class User
{
    private $name;
    private $email;

    public function __construct($name, $email)
    {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName()
    {
        return $this->name;
    }
    public function getEmail()
    {
        return $this->email;
    }
}

class UserRepository
{
    public function save(User $user)
    {
        echo "Saving user {$user->getName()} to database\n";
    }
}

class EmailService
{
    public function send(User $user)
    {
        echo "Sending email to {$user->getEmail()}\n";
    }
}

// Usage
$user = new User("Alice", "alice@example.com");
$userRepo = new UserRepository();
$emailService = new EmailService();

$userRepo->save($user);
$emailService->send($user);
