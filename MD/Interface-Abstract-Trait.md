---
---

# 📌 PHP OOP Example: Abstract vs Interface vs Trait

```php
<?php
/**
 * 1. INTERFACE
 * Defines only the contract (what methods a class MUST implement)
 */
interface PaymentGateway {
    public function pay(float $amount): string;
}


/**
 * 2. TRAIT
 * Provides reusable methods that can be shared across multiple classes
 */
trait CurrencyFormatter {
    public function formatAmount(float $amount): string {
        return "₹" . number_format($amount, 2);
    }
}


/**
 * 3. ABSTRACT CLASS
 * Provides partial implementation and common behavior.
 * Can include abstract methods (must be implemented in child).
 */
abstract class BasePayment implements PaymentGateway {
    use CurrencyFormatter; // mixing in trait

    protected string $gatewayName;

    public function __construct(string $gatewayName) {
        $this->gatewayName = $gatewayName;
    }

    // Common reusable method
    public function log(float $amount): void {
        echo "[LOG] " . $this->gatewayName . " processed " .
             $this->formatAmount($amount) . PHP_EOL;
    }

    // Force child class to implement its own payment logic
    abstract public function pay(float $amount): string;
}


/**
 * 4. CONCRETE CLASSES
 * Implement the abstract class and define specific behavior
 */
class PayPalPayment extends BasePayment {
    public function __construct() {
        parent::__construct("PayPal");
    }

    public function pay(float $amount): string {
        $this->log($amount);
        return "Payment of " . $this->formatAmount($amount) . " done via PayPal.";
    }
}

class StripePayment extends BasePayment {
    public function __construct() {
        parent::__construct("Stripe");
    }

    public function pay(float $amount): string {
        $this->log($amount);
        return "Payment of " . $this->formatAmount($amount) . " done via Stripe.";
    }
}


/**
 * 5. USAGE / DEMO
 */
$paypal = new PayPalPayment();
echo $paypal->pay(1500.75) . PHP_EOL;

$stripe = new StripePayment();
echo $stripe->pay(500.25) . PHP_EOL;
```

---

# ✅ Output (example)

```
[LOG] PayPal processed ₹1,500.75
Payment of ₹1,500.75 done via PayPal.
[LOG] Stripe processed ₹500.25
Payment of ₹500.25 done via Stripe.
```

---

# 🔑 Summary

- **Interface** → only defines what methods must exist (`pay()`), no logic inside.
- **Abstract class** → can hold shared logic (`log()`, constructor) and also force child classes to implement abstract methods.
- **Trait** → adds reusable code (`formatAmount()`) that can be shared across unrelated classes.

---

✅ Key Differences Shown:

Interface → ensures all payment classes have a pay() method.

Abstract class → shares reusable structure (logging, constructor, protected members).

Trait → adds common helpers (transaction ID, currency formatting) across multiple unrelated classes
