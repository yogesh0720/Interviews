<?php
abstract class Factory
{
    abstract public static function create();
}

class Enemy extends Factory
{
    public static function create(): Enemy
    {
        return new Enemy();
    }

    public function attack(): string
    {
        return "Enemy attacks!";
    }
}

// Usage
$enemy = Enemy::create();
echo $enemy->attack(); //Enemy attacks!
