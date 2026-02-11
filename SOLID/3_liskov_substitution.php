<?php

/**
 * L – Liskov Substitution Principle (LSP)
 * 
 * WHEN TO USE:
 * - When designing inheritance or interface hierarchies
 * - When creating polymorphic behavior
 * 
 * WHY TO USE:
 * - Ensure polymorphism works correctly
 * - Prevent runtime surprises and exceptions
 * - Subtypes should behave like their parent
 */

// ❌ BAD: Penguin breaks Bird contract
class BirdBad
{
    public function fly()
    {
        echo "Flying\n";
    }
}

class PenguinBad extends BirdBad
{
    public function fly()
    {
        throw new Exception("Penguins can't fly!");
    }
}

// ✅ GOOD: Proper abstraction hierarchy
interface Bird
{
    public function eat();
    public function move();
}

interface FlyingBird extends Bird
{
    public function fly();
}

class Sparrow implements FlyingBird
{
    public function eat()
    {
        echo "Sparrow eating seeds\n";
    }

    public function move()
    {
        $this->fly();
    }

    public function fly()
    {
        echo "Sparrow flying\n";
    }
}

class Penguin implements Bird
{
    public function eat()
    {
        echo "Penguin eating fish\n";
    }

    public function move()
    {
        echo "Penguin swimming\n";
    }
}

// Usage: Both work correctly without exceptions
function makeBirdMove(Bird $bird)
{
    $bird->eat();
    $bird->move();
}

$sparrow = new Sparrow();
$penguin = new Penguin();

makeBirdMove($sparrow);
makeBirdMove($penguin);
