<?php

/*
    1️⃣ Factory Pattern
    ❓ When to use
    Object creation depends on type / condition
    You want to hide new keyword
    Multiple implementations of same interface
    ✅ Real use case
    Payment gateways, notification services, user roles
    📌 Example: Payment Service Factory
    Use Factory when creation logic changes
*/

interface PaymentService
{
    public function pay(float $amount): string;
}

class StripePayment implements PaymentService
{
    public function pay(float $amount): string
    {
        return "Paid ₹$amount via Stripe";
    }
}

class RazorpayPayment implements PaymentService
{
    public function pay(float $amount): string
    {
        return "Paid ₹$amount via Razorpay";
    }
}

class PaymentFactory
{
    public function make(string $type): PaymentService
    {
        return match ($type) {
            'stripe' => new StripePayment(),
            'razorpay' => new RazorpayPayment(),
            default => throw new InvalidArgumentException("Invalid payment type"),
        };
    }
}

// 👉 Use Factory when creation logic changes
$paymentFactory = new PaymentFactory();
$paymentService = $paymentFactory->make('stripe');
echo $paymentService->pay(100.00);

$paymentService = $paymentFactory->make('razorpay');
echo $paymentService->pay(25.00);
