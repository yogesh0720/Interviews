<?php

/*
    4️⃣ Observer Pattern
    ❓ When to use
    Event-driven behavior
    One action → multiple reactions
    ✅ Real use case
    Order placed → send email, update stock, notify admin
*/

interface Observer
{
    public function update(string $event): void;
}

class EmailNotifier implements Observer
{
    public function update(string $event): void
    {
        echo "Email sent for $event\n";
    }
}

class OrderPlaced
{
    private array $observers = [];

    public function attach(Observer $observer): void
    {
        $this->observers[] = $observer;
    }

    public function notify(): void
    {
        foreach ($this->observers as $observer) {
            $observer->update('order_placed');
        }
    }
}
// 👉 Use Observer for decoupled event handling
$orderPlaced = new OrderPlaced();
$orderPlaced->attach(new EmailNotifier());
$orderPlaced->notify();
