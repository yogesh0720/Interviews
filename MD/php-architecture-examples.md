- **Monolith**
- **SOA**
- **Microservices**

Here’s the plan:

---

## 📂 Project Structure

```
php-architecture-examples/
│
├── monolith/
│   └── index.php
│
├── soa/
│   ├── index.php
│   ├── ProductService.php
│   └── CheckoutService.php
│
└── microservices/
    ├── ApiGateway.php
    ├── UserService.php
    └── OrderService.php
```

---

## **1. Monolith Example**

📄 `monolith/index.php`

```php
<?php
// Monolithic OOP Example

class Product {
    public function list() {
        return ["Phone", "Laptop", "Tablet"];
    }
}

class Checkout {
    public function process($product) {
        return "Checkout started for $product";
    }
}

// Everything in one app
$product = new Product();
$checkout = new Checkout();

echo "Products: " . implode(", ", $product->list()) . "<br>";
echo $checkout->process("Laptop");
```

---

## **2. SOA Example**

📄 `soa/ProductService.php`

```php
<?php
class ProductService {
    public function getProducts() {
        return ["Phone", "Laptop", "Tablet"];
    }
}
```

📄 `soa/CheckoutService.php`

```php
<?php
require_once "ProductService.php";

class CheckoutService {
    public function startCheckout($product) {
        $productService = new ProductService();
        $products = $productService->getProducts();

        if (in_array($product, $products)) {
            return "Checkout started for $product";
        }
        return "Product not found!";
    }
}
```

📄 `soa/index.php`

```php
<?php
require_once "CheckoutService.php";

$checkout = new CheckoutService();
echo $checkout->startCheckout("Laptop");
```

---

## **3. Microservices Example**

📄 `microservices/UserService.php`

```php
<?php
class UserService {
    public function getUsers() {
        return [
            ["id" => 1, "name" => "Yogesh"],
            ["id" => 2, "name" => "Nayi"]
        ];
    }
}

header("Content-Type: application/json");
echo json_encode((new UserService())->getUsers());
```

📄 `microservices/OrderService.php`

```php
<?php
class OrderService {
    public function getOrders() {
        return [
            ["id" => 101, "user_id" => 1, "product" => "Laptop"],
            ["id" => 102, "user_id" => 2, "product" => "Phone"]
        ];
    }
}

header("Content-Type: application/json");
echo json_encode((new OrderService())->getOrders());
```

📄 `microservices/ApiGateway.php`

```php
<?php
class ApiGateway {
    public function aggregate() {
        $users = json_decode(file_get_contents("http://localhost/microservices/UserService.php"), true);
        $orders = json_decode(file_get_contents("http://localhost/microservices/OrderService.php"), true);

        return [
            "users" => $users,
            "orders" => $orders
        ];
    }
}

header("Content-Type: application/json");
echo json_encode((new ApiGateway())->aggregate());
```

---

✅ **How to run locally:**

1. Save this folder as `php-architecture-examples`.
2. Open terminal in that folder and run:

```sh
php -S localhost:8000
```

3. Open in browser:

   - `http://localhost:8000/monolith/index.php`
   - `http://localhost:8000/soa/index.php`
   - `http://localhost:8000/microservices/ApiGateway.php`

---
