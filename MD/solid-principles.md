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

**When to use:**
Use SRP when a class starts handling multiple concerns (business logic + persistence + communication).

**Why to use:**
To make code easier to understand, test, and modify without causing side effects.

✅ **Good Example:**

```php
class User {
    private $name;
    private $email;

    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
    }

    public function getName() { return $this->name; }
    public function getEmail() { return $this->email; }
}

class UserRepository {
    public function save(User $user) {
        echo "Saving user {$user->getName()} to database\n";
    }
}

class EmailService {
    public function send(User $user) {
        echo "Sending email to {$user->getEmail()}\n";
    }
}

// Usage:
$user = new User("Alice", "alice@example.com");
$userRepo = new UserRepository();
$emailService = new EmailService();

$userRepo->save($user);
$emailService->send($user);
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

**When to use:**
Use OCP when new features or behaviors are added frequently (e.g., payment methods, notification types).

**Why to use:**
To avoid breaking existing code while safely extending functionality.

Every new payment method requires editing this class.

✅ **Good Example (use polymorphism):**

```php
interface PaymentMethod {
    public function pay($amount);
}

class PaypalPayment implements PaymentMethod {
    public function pay($amount) {
        echo "Paid $amount with PayPal\n";
    }
}

class StripePayment implements PaymentMethod {
    public function pay($amount) {
        echo "Paid $amount with Stripe\n";
    }
}

class GooglePayPayment implements PaymentMethod {
    public function pay($amount) {
        echo "Paid $amount with Google Pay\n";
    }
}

class PaymentProcessor {
    public function process(PaymentMethod $paymentMethod, $amount) {
        $paymentMethod->pay($amount);
    }
}

// Usage:
$processor = new PaymentProcessor();
$processor->process(new PaypalPayment(), 100);
$processor->process(new StripePayment(), 200);
$processor->process(new GooglePayPayment(), 150);
```

Now, adding new methods requires no modification to existing code.

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

**When to use:**
Use LSP when designing inheritance or interface hierarchies.

**Why to use:**
To ensure polymorphism works correctly and prevent runtime surprises.

Replacing `Bird` with `Penguin` breaks expectations.

✅ **Good Example:**

```php
interface Bird {
    public function eat();
    public function move();
}

interface FlyingBird extends Bird {
    public function fly();
}

class Sparrow implements FlyingBird {
    public function eat() {
        echo "Sparrow eating seeds\n";
    }

    public function move() {
        $this->fly();
    }

    public function fly() {
        echo "Sparrow flying\n";
    }
}

class Penguin implements Bird {
    public function eat() {
        echo "Penguin eating fish\n";
    }

    public function move() {
        echo "Penguin swimming\n";
    }
}

// Usage:
function makeBirdMove(Bird $bird) {
    $bird->eat();
    $bird->move();
}

$sparrow = new Sparrow();
$penguin = new Penguin();

makeBirdMove($sparrow); // Works fine
makeBirdMove($penguin); // Also works fine - no exceptions
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

**When to use:**
Use ISP when interfaces become large, bloated, or partially implemented.

**Why to use:**
To keep implementations clean, focused, and flexible.

✅ **Good Example:**

```php
interface Printer {
    public function print($document);
}

interface Scanner {
    public function scan();
}

interface Fax {
    public function fax($document);
}

class BasicPrinter implements Printer {
    public function print($document) {
        echo "Printing: $document\n";
    }
}

class MultiFunctionPrinter implements Printer, Scanner, Fax {
    public function print($document) {
        echo "MFP Printing: $document\n";
    }

    public function scan() {
        echo "MFP Scanning document\n";
        return "scanned_document.pdf";
    }

    public function fax($document) {
        echo "MFP Faxing: $document\n";
    }
}

// Usage:
$basicPrinter = new BasicPrinter();
$basicPrinter->print("report.pdf");

$mfp = new MultiFunctionPrinter();
$mfp->print("contract.pdf");
$scanned = $mfp->scan();
$mfp->fax($scanned);
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

**When to use:**
Use DIP when building scalable systems or when dependencies may change (DB, API, services).

**Why to use:**
To reduce tight coupling and enable easy replacement, testing, and mocking.

✅ **Good Example:**

```php
interface Database {
    public function connect();
    public function save($data);
    public function find($id);
}

class MySQLDatabase implements Database {
    public function connect() {
        echo "Connected to MySQL\n";
    }

    public function save($data) {
        echo "Saving to MySQL: $data\n";
    }

    public function find($id) {
        echo "Finding in MySQL: $id\n";
        return "user_data_$id";
    }
}

class PostgreSQLDatabase implements Database {
    public function connect() {
        echo "Connected to PostgreSQL\n";
    }

    public function save($data) {
        echo "Saving to PostgreSQL: $data\n";
    }

    public function find($id) {
        echo "Finding in PostgreSQL: $id\n";
        return "user_data_$id";
    }
}

class UserService {
    private $db;

    public function __construct(Database $db) {
        $this->db = $db; // depends on abstraction
        $this->db->connect();
    }

    public function createUser($userData) {
        $this->db->save($userData);
    }

    public function getUser($id) {
        return $this->db->find($id);
    }
}

// Usage - Easy to switch databases:
$mysqlDb = new MySQLDatabase();
$userService1 = new UserService($mysqlDb);
$userService1->createUser("John Doe");

$postgresDb = new PostgreSQLDatabase();
$userService2 = new UserService($postgresDb);
$userService2->createUser("Jane Smith");
```

---

🔑 **Summary**

- **S** – One responsibility per class.
- **O** – Extend without modifying existing code.
- **L** – Subtypes should behave like their parent.
- **I** – Small, focused interfaces.
- **D** – Depend on abstractions, not concrete classes.

## Complete Working Example - All SOLID Principles Together

```php
<?php

// 1. SRP - Each class has single responsibility
class Order {
    private $items = [];
    private $total = 0;

    public function addItem($item, $price) {
        $this->items[] = ['item' => $item, 'price' => $price];
        $this->total += $price;
    }

    public function getTotal() { return $this->total; }
    public function getItems() { return $this->items; }
}

// 2. DIP - Depend on abstractions
interface PaymentProcessor {
    public function processPayment($amount);
}

interface NotificationService {
    public function send($message);
}

interface OrderRepository {
    public function save(Order $order);
}

// 3. OCP - Open for extension, closed for modification
class CreditCardProcessor implements PaymentProcessor {
    public function processPayment($amount) {
        echo "Processing $amount via Credit Card\n";
        return true;
    }
}

class PayPalProcessor implements PaymentProcessor {
    public function processPayment($amount) {
        echo "Processing $amount via PayPal\n";
        return true;
    }
}

// 4. ISP - Small, focused interfaces
class EmailNotification implements NotificationService {
    public function send($message) {
        echo "Email: $message\n";
    }
}

class SMSNotification implements NotificationService {
    public function send($message) {
        echo "SMS: $message\n";
    }
}

class DatabaseOrderRepository implements OrderRepository {
    public function save(Order $order) {
        echo "Saving order with total: {$order->getTotal()}\n";
    }
}

// 5. LSP - Substitutable implementations
class OrderService {
    private $paymentProcessor;
    private $notificationService;
    private $orderRepository;

    public function __construct(
        PaymentProcessor $paymentProcessor,
        NotificationService $notificationService,
        OrderRepository $orderRepository
    ) {
        $this->paymentProcessor = $paymentProcessor;
        $this->notificationService = $notificationService;
        $this->orderRepository = $orderRepository;
    }

    public function processOrder(Order $order) {
        $paymentSuccess = $this->paymentProcessor->processPayment($order->getTotal());

        if ($paymentSuccess) {
            $this->orderRepository->save($order);
            $this->notificationService->send("Order processed successfully!");
            return true;
        }

        return false;
    }
}

// Usage:
$order = new Order();
$order->addItem("Laptop", 1000);
$order->addItem("Mouse", 25);

$orderService = new OrderService(
    new CreditCardProcessor(),
    new EmailNotification(),
    new DatabaseOrderRepository()
);

$orderService->processOrder($order);
?>
```

**Output:**

```
Processing 1025 via Credit Card
Saving order with total: 1025
Email: Order processed successfully!
```

---

**Dependency Inversion** and **Dependency Injection** because they sound similar, but they are not the same. Let me break it down clearly with **definition + difference + PHP example**.

---

## 1. **Dependency Inversion Principle (DIP)**

- It is one of the **SOLID principles** (the **D** in SOLID).
- States that:
  **High-level modules should not depend on low-level modules. Both should depend on abstractions.**
- Idea: Depend on **interfaces/abstract classes**, not concrete implementations.

**When to use:**
Use DIP when building scalable systems or when dependencies may change (DB, API, services).

**Why to use:**
To reduce tight coupling and enable easy replacement, testing, and mocking.

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

**When to use:**
Use DI when applying DIP and when you want configurable or testable dependencies.

**Why to use:**
To improve testability, flexibility, and maintainability.

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
