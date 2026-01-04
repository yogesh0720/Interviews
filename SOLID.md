**SOLID principles** in the context of **PHP**, with short explanations and code snippets for clarity.

---

## 1. **S – Single Responsibility Principle (SRP)**

A class should have **only one reason to change**, i.e., it should do one thing.

❌ **Bad Example:**

```php
class User {
    public function saveToDatabase() {
        // logic to save user
    }

    public function sendEmail() {
        // logic to send email
    }
}
```

Here, the class handles **both persistence and communication** → multiple responsibilities.

✅ **Good Example:**

```php
class User {
    // User properties & methods
}

class UserRepository {
    public function save(User $user) {
        // save to DB
    }
}

class EmailService {
    public function send(User $user) {
        // send email
    }
}
```

---

## 2. **O – Open/Closed Principle (OCP)**

Software entities should be **open for extension but closed for modification**.

❌ **Bad Example:**

```php
class Payment {
    public function pay($type) {
        if ($type === 'paypal') {
            // PayPal payment logic
        } elseif ($type === 'stripe') {
            // Stripe payment logic
        }
    }
}
```

Every new payment method requires editing this class.

✅ **Good Example (use polymorphism):**

```php
interface PaymentMethod {
    public function pay();
}

class PaypalPayment implements PaymentMethod {
    public function pay() {
        echo "Paid with PayPal";
    }
}

class StripePayment implements PaymentMethod {
    public function pay() {
        echo "Paid with Stripe";
    }
}

class PaymentProcessor {
    public function process(PaymentMethod $paymentMethod) {
        $paymentMethod->pay();
    }
}
```

Now, adding new methods (e.g., GooglePay) requires no modification to existing code.

---

## 3. **L – Liskov Substitution Principle (LSP)**

Objects of a superclass should be replaceable with objects of a subclass without breaking functionality.

❌ **Bad Example:**

```php
class Bird {
    public function fly() {
        echo "Flying";
    }
}

class Penguin extends Bird {
    public function fly() {
        throw new Exception("Penguins can't fly!");
    }
}
```

Replacing `Bird` with `Penguin` breaks expectations.

✅ **Good Example:**

```php
interface Bird {
    public function eat();
}

interface FlyingBird extends Bird {
    public function fly();
}

class Sparrow implements FlyingBird {
    public function eat() {}
    public function fly() {}
}

class Penguin implements Bird {
    public function eat() {}
}
```

---

## 4. **I – Interface Segregation Principle (ISP)**

Clients should not be forced to implement interfaces they don’t use.

❌ **Bad Example:**

```php
interface Machine {
    public function print();
    public function scan();
    public function fax();
}

class OldPrinter implements Machine {
    public function print() {}
    public function scan() { throw new Exception("Not supported"); }
    public function fax() { throw new Exception("Not supported"); }
}
```

✅ **Good Example:**

```php
interface Printer {
    public function print();
}

interface Scanner {
    public function scan();
}

class BasicPrinter implements Printer {
    public function print() {}
}

class MultiFunctionPrinter implements Printer, Scanner {
    public function print() {}
    public function scan() {}
}
```

---

## 5. **D – Dependency Inversion Principle (DIP)**

High-level modules should not depend on low-level modules. Both should depend on **abstractions**.

❌ **Bad Example:**

```php
class MySQLDatabase {
    public function connect() {}
}

class UserService {
    private $db;

    public function __construct() {
        $this->db = new MySQLDatabase(); // tightly coupled
    }
}
```

✅ **Good Example:**

```php
interface Database {
    public function connect();
}

class MySQLDatabase implements Database {
    public function connect() {}
}

class UserService {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db; // depends on abstraction
    }
}
```

---

🔑 **Summary**

- **S** – One responsibility per class.
- **O** – Extend without modifying existing code.
- **L** – Subtypes should behave like their parent.
- **I** – Small, focused interfaces.
- **D** – Depend on abstractions, not concrete classes.

---

**Dependency Inversion** and **Dependency Injection** because they sound similar, but they are not the same. Let me break it down clearly with **definition + difference + PHP example**.

---

## 1. **Dependency Inversion Principle (DIP)**

- It is one of the **SOLID principles** (the **D** in SOLID).
- States that:
  **High-level modules should not depend on low-level modules. Both should depend on abstractions.**
- Idea: Depend on **interfaces/abstract classes**, not concrete implementations.

✅ Example:

```php
interface Database {
    public function connect();
}

class MySQLDatabase implements Database {
    public function connect() {
        echo "MySQL connected";
    }
}

class UserService {
    private $db;

    // Notice: depends on abstraction (Database), not concrete MySQLDatabase
    public function __construct(Database $db) {
        $this->db = $db;
    }
}
```

Here, `UserService` does not care if it’s MySQL, PostgreSQL, or MongoDB — only that it gets a `Database`.

---

## 2. **Dependency Injection (DI)**

- It is a **design pattern / technique** to **implement** Dependency Inversion.
- Instead of a class creating its own dependencies, they are **injected from outside** (via constructor, setter, or method injection).
- It answers _"How do we supply the dependency?"_

✅ Example (Constructor Injection):

```php
$db = new MySQLDatabase();
$userService = new UserService($db); // injecting dependency
```

Without DI, the class might look like this:

```php
class UserService {
    private $db;

    public function __construct() {
        $this->db = new MySQLDatabase(); // tightly coupled
    }
}
```

This violates DIP because the high-level module (`UserService`) directly depends on a low-level concrete class (`MySQLDatabase`).

---

## 🔑 Key Differences

| Aspect      | Dependency Inversion (DIP)                                            | Dependency Injection (DI)                                    |
| ----------- | --------------------------------------------------------------------- | ------------------------------------------------------------ |
| **Type**    | Principle (from SOLID)                                                | Design Pattern / Technique                                   |
| **What**    | States that code should depend on abstractions, not concrete classes. | A way to provide those abstractions (by injecting them).     |
| **Focus**   | The _relationship_ between high-level & low-level modules.            | The _mechanism_ of passing dependencies into a class.        |
| **Example** | Use `Database` interface instead of `MySQLDatabase` directly.         | Pass `MySQLDatabase` into `UserService` through constructor. |

---

👉 In short:

- **Dependency Inversion** = _"Depend on abstractions, not implementations."_
- **Dependency Injection** = _"How those abstractions are provided (injected) into a class."_

---
