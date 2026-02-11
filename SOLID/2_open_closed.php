<?php

/**
 * O – Open/Closed Principle (OCP)
 * 
 * WHEN TO USE:
 * - When new features or behaviors are added frequently
 * - Payment methods, notification types, report formats
 * 
 * WHY TO USE:
 * - Avoid breaking existing code while extending functionality
 * - Add new features without modifying tested code
 */

// ❌ BAD: Must modify class for each new payment method
class PaymentBad
{
    public function pay($type, $amount)
    {
        if ($type === 'paypal') {
            echo "Paid $amount with PayPal\n";
        } elseif ($type === 'stripe') {
            echo "Paid $amount with Stripe\n";
        }
        // Adding new method requires modifying this class
    }
}

// ✅ GOOD: Open for extension, closed for modification
interface PaymentMethod
{
    public function pay($amount);
}

class PaypalPayment implements PaymentMethod
{
    public function pay($amount)
    {
        echo "Paid $amount with PayPal\n";
    }
}

class StripePayment implements PaymentMethod
{
    public function pay($amount)
    {
        echo "Paid $amount with Stripe\n";
    }
}

class GooglePayPayment implements PaymentMethod
{
    public function pay($amount)
    {
        echo "Paid $amount with Google Pay\n";
    }
}

class PaymentProcessor
{
    public function process(PaymentMethod $paymentMethod, $amount)
    {
        $paymentMethod->pay($amount);
    }
}

// Usage: Adding new payment methods requires no modification
$processor = new PaymentProcessor();
$processor->process(new PaypalPayment(), 100);
$processor->process(new StripePayment(), 200);
$processor->process(new GooglePayPayment(), 150);
