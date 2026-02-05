<?php

/*
    2️⃣ Strategy Pattern
    ❓ When to use
    Same action, different algorithms
    Behavior changes at runtime
    Avoid large if/else blocks
    ✅ Real use case
    Discount calculation, tax rules, sorting logic
    📌 Example: Discount Strategy
*/

interface DiscountStrategy
{
    public function calculate(float $amount): float;
}

class FestivalDiscount implements DiscountStrategy
{
    public function calculate(float $amount): float
    {
        return $amount * 0.20; // 20% discount
    }
}

class NoDiscount implements DiscountStrategy
{
    public function calculate(float $amount): float
    {
        return 0;
    }
}

class BillingService
{
    public function __construct(
        private DiscountStrategy $discount
    ) {}

    public function total(float $amount): float
    {
        return $amount - $this->discount->calculate($amount);
    }
}

//👉 Use Strategy when behavior changes, not object
$service = new BillingService(new FestivalDiscount());
echo $service->total(100);
