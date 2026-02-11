<?php

/**
 * Complete SOLID Principles Example
 * 
 * This example demonstrates all 5 SOLID principles working together
 * in a real-world e-commerce order processing system
 */

// ===== SINGLE RESPONSIBILITY PRINCIPLE =====
// Each class has one responsibility

class Order
{
    private $items = [];
    private $total = 0;

    public function addItem($item, $price)
    {
        $this->items[] = ['item' => $item, 'price' => $price];
        $this->total += $price;
    }

    public function getTotal()
    {
        return $this->total;
    }
    public function getItems()
    {
        return $this->items;
    }
}

// ===== DEPENDENCY INVERSION PRINCIPLE =====
// Depend on abstractions, not concrete classes

interface PaymentProcessor
{
    public function processPayment($amount);
}

interface NotificationService
{
    public function send($message);
}

interface OrderRepository
{
    public function save(Order $order);
}

// ===== OPEN/CLOSED PRINCIPLE =====
// Open for extension, closed for modification

class CreditCardProcessor implements PaymentProcessor
{
    public function processPayment($amount)
    {
        echo "Processing credit card payment: $$amount\n";
        return true;
    }
}

class PayPalProcessor implements PaymentProcessor
{
    public function processPayment($amount)
    {
        echo "Processing PayPal payment: $$amount\n";
        return true;
    }
}

class EmailNotification implements NotificationService
{
    public function send($message)
    {
        echo "Sending email: $message\n";
    }
}

class SMSNotification implements NotificationService
{
    public function send($message)
    {
        echo "Sending SMS: $message\n";
    }
}

class DatabaseOrderRepository implements OrderRepository
{
    public function save(Order $order)
    {
        echo "Saving order to database. Total: $" . $order->getTotal() . "\n";
    }
}

// ===== INTERFACE SEGREGATION PRINCIPLE =====
// Small, focused interfaces instead of one large interface

interface OrderProcessor
{
    public function process(Order $order);
}

interface OrderValidator
{
    public function validate(Order $order);
}

// ===== LISKOV SUBSTITUTION PRINCIPLE =====
// Subtypes can replace parent types without breaking functionality

class OrderService implements OrderProcessor, OrderValidator
{
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

    public function validate(Order $order)
    {
        if ($order->getTotal() <= 0) {
            throw new Exception("Order total must be greater than 0");
        }
        echo "Order validated successfully\n";
        return true;
    }

    public function process(Order $order)
    {
        // Validate
        $this->validate($order);

        // Process payment
        $paymentSuccess = $this->paymentProcessor->processPayment($order->getTotal());

        if ($paymentSuccess) {
            // Save order
            $this->orderRepository->save($order);

            // Send notification
            $this->notificationService->send("Order processed successfully!");
        }
    }
}

// ===== USAGE DEMONSTRATION =====

echo "=== Order Processing with Credit Card & Email ===\n";
$order1 = new Order();
$order1->addItem("Laptop", 1000);
$order1->addItem("Mouse", 50);

$orderService1 = new OrderService(
    new CreditCardProcessor(),
    new EmailNotification(),
    new DatabaseOrderRepository()
);
$orderService1->process($order1);

echo "\n=== Order Processing with PayPal & SMS ===\n";
$order2 = new Order();
$order2->addItem("Phone", 800);

$orderService2 = new OrderService(
    new PayPalProcessor(),
    new SMSNotification(),
    new DatabaseOrderRepository()
);
$orderService2->process($order2);

echo "\n✅ All SOLID principles demonstrated successfully!\n";
