# SOLID Principles in Laravel

Complete guide to implementing SOLID principles in Laravel applications with practical examples.

---

## 1. Single Responsibility Principle (SRP)

**Each class should have one responsibility**

### ❌ Bad Example

```php
// Controller doing too much
class UserController extends Controller
{
    public function store(Request $request)
    {
        // Validation
        $validated = $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        // Business logic
        $user = new User();
        $user->name = $validated['name'];
        $user->email = $validated['email'];
        $user->save();

        // Send email
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // Log activity
        Log::info("User created: {$user->id}");

        return response()->json($user);
    }
}
```

### ✅ Good Example

```php
// app/Http/Controllers/UserController.php
class UserController extends Controller
{
    public function __construct(
        private UserService $userService
    ) {}

    public function store(StoreUserRequest $request)
    {
        $user = $this->userService->createUser($request->validated());
        return new UserResource($user);
    }
}

// app/Http/Requests/StoreUserRequest.php
class StoreUserRequest extends FormRequest
{
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
        ];
    }
}

// app/Services/UserService.php
class UserService
{
    public function __construct(
        private UserRepository $repository,
        private NotificationService $notificationService
    ) {}

    public function createUser(array $data): User
    {
        $user = $this->repository->create($data);
        $this->notificationService->sendWelcomeEmail($user);
        
        return $user;
    }
}

// app/Repositories/UserRepository.php
class UserRepository
{
    public function create(array $data): User
    {
        return User::create($data);
    }
}

// app/Services/NotificationService.php
class NotificationService
{
    public function sendWelcomeEmail(User $user): void
    {
        Mail::to($user->email)->send(new WelcomeEmail($user));
    }
}
```

---

## 2. Open/Closed Principle (OCP)

**Open for extension, closed for modification**

### ❌ Bad Example

```php
class PaymentController extends Controller
{
    public function process(Request $request)
    {
        $type = $request->input('type');

        if ($type === 'stripe') {
            // Stripe logic
            Stripe::charge($request->amount);
        } elseif ($type === 'paypal') {
            // PayPal logic
            PayPal::charge($request->amount);
        } elseif ($type === 'razorpay') {
            // Razorpay logic
            Razorpay::charge($request->amount);
        }
    }
}
```

### ✅ Good Example

```php
// app/Contracts/PaymentGateway.php
interface PaymentGateway
{
    public function charge(float $amount): bool;
}

// app/Services/Payments/StripePayment.php
class StripePayment implements PaymentGateway
{
    public function charge(float $amount): bool
    {
        return Stripe::charges()->create(['amount' => $amount]);
    }
}

// app/Services/Payments/PayPalPayment.php
class PayPalPayment implements PaymentGateway
{
    public function charge(float $amount): bool
    {
        return PayPal::payment()->create(['amount' => $amount]);
    }
}

// app/Services/PaymentService.php
class PaymentService
{
    public function __construct(
        private PaymentGateway $gateway
    ) {}

    public function processPayment(float $amount): bool
    {
        return $this->gateway->charge($amount);
    }
}

// app/Providers/AppServiceProvider.php
public function register()
{
    $this->app->bind(PaymentGateway::class, function ($app) {
        $gateway = config('payment.default');
        
        return match($gateway) {
            'stripe' => new StripePayment(),
            'paypal' => new PayPalPayment(),
            default => throw new Exception("Invalid gateway"),
        };
    });
}

// app/Http/Controllers/PaymentController.php
class PaymentController extends Controller
{
    public function __construct(
        private PaymentService $paymentService
    ) {}

    public function process(Request $request)
    {
        $success = $this->paymentService->processPayment($request->amount);
        return response()->json(['success' => $success]);
    }
}
```

---

## 3. Liskov Substitution Principle (LSP)

**Subtypes must be substitutable for their base types**

### ❌ Bad Example

```php
abstract class Report
{
    abstract public function generate(): string;
    abstract public function export(): void;
}

class PdfReport extends Report
{
    public function generate(): string
    {
        return "PDF content";
    }

    public function export(): void
    {
        // Export to file
    }
}

class LiveReport extends Report
{
    public function generate(): string
    {
        return "Live data";
    }

    public function export(): void
    {
        throw new Exception("Live reports cannot be exported");
    }
}
```

### ✅ Good Example

```php
// app/Contracts/Report.php
interface Report
{
    public function generate(): string;
}

// app/Contracts/Exportable.php
interface Exportable
{
    public function export(): void;
}

// app/Services/Reports/PdfReport.php
class PdfReport implements Report, Exportable
{
    public function generate(): string
    {
        return "PDF content";
    }

    public function export(): void
    {
        Storage::put('reports/report.pdf', $this->generate());
    }
}

// app/Services/Reports/LiveReport.php
class LiveReport implements Report
{
    public function generate(): string
    {
        return "Live data from database";
    }
}

// app/Services/ReportService.php
class ReportService
{
    public function displayReport(Report $report): string
    {
        return $report->generate();
    }

    public function saveReport(Exportable $report): void
    {
        $report->export();
    }
}
```

---

## 4. Interface Segregation Principle (ISP)

**Clients should not depend on interfaces they don't use**

### ❌ Bad Example

```php
interface Worker
{
    public function work();
    public function eat();
    public function sleep();
}

class HumanWorker implements Worker
{
    public function work() { /* work */ }
    public function eat() { /* eat */ }
    public function sleep() { /* sleep */ }
}

class RobotWorker implements Worker
{
    public function work() { /* work */ }
    public function eat() { throw new Exception("Robots don't eat"); }
    public function sleep() { throw new Exception("Robots don't sleep"); }
}
```

### ✅ Good Example

```php
// app/Contracts/Workable.php
interface Workable
{
    public function work();
}

// app/Contracts/Feedable.php
interface Feedable
{
    public function eat();
}

// app/Contracts/Sleepable.php
interface Sleepable
{
    public function sleep();
}

// app/Services/Workers/HumanWorker.php
class HumanWorker implements Workable, Feedable, Sleepable
{
    public function work()
    {
        echo "Human working\n";
    }

    public function eat()
    {
        echo "Human eating\n";
    }

    public function sleep()
    {
        echo "Human sleeping\n";
    }
}

// app/Services/Workers/RobotWorker.php
class RobotWorker implements Workable
{
    public function work()
    {
        echo "Robot working\n";
    }
}

// app/Services/WorkManager.php
class WorkManager
{
    public function manage(Workable $worker)
    {
        $worker->work();
    }

    public function provideLunch(Feedable $worker)
    {
        $worker->eat();
    }
}
```

---

## 5. Dependency Inversion Principle (DIP)

**Depend on abstractions, not concretions**

### ❌ Bad Example

```php
class OrderController extends Controller
{
    public function store(Request $request)
    {
        // Tightly coupled to Eloquent
        $order = Order::create($request->all());
        
        // Tightly coupled to Mail facade
        Mail::to($order->user->email)->send(new OrderConfirmation($order));
        
        return response()->json($order);
    }
}
```

### ✅ Good Example

```php
// app/Contracts/OrderRepositoryInterface.php
interface OrderRepositoryInterface
{
    public function create(array $data): Order;
    public function find(int $id): ?Order;
}

// app/Contracts/NotificationInterface.php
interface NotificationInterface
{
    public function sendOrderConfirmation(Order $order): void;
}

// app/Repositories/EloquentOrderRepository.php
class EloquentOrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }

    public function find(int $id): ?Order
    {
        return Order::find($id);
    }
}

// app/Services/EmailNotification.php
class EmailNotification implements NotificationInterface
{
    public function sendOrderConfirmation(Order $order): void
    {
        Mail::to($order->user->email)->send(new OrderConfirmation($order));
    }
}

// app/Services/OrderService.php
class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private NotificationInterface $notification
    ) {}

    public function createOrder(array $data): Order
    {
        $order = $this->orderRepository->create($data);
        $this->notification->sendOrderConfirmation($order);
        
        return $order;
    }
}

// app/Http/Controllers/OrderController.php
class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function store(StoreOrderRequest $request)
    {
        $order = $this->orderService->createOrder($request->validated());
        return new OrderResource($order);
    }
}

// app/Providers/AppServiceProvider.php
public function register()
{
    $this->app->bind(
        OrderRepositoryInterface::class,
        EloquentOrderRepository::class
    );

    $this->app->bind(
        NotificationInterface::class,
        EmailNotification::class
    );
}
```

---

## Complete Laravel Example - E-Commerce Order System

```php
// app/Contracts/PaymentGatewayInterface.php
interface PaymentGatewayInterface
{
    public function charge(float $amount): bool;
}

// app/Contracts/OrderRepositoryInterface.php
interface OrderRepositoryInterface
{
    public function create(array $data): Order;
}

// app/Contracts/NotificationInterface.php
interface NotificationInterface
{
    public function notify(Order $order): void;
}

// app/Services/Payments/StripeGateway.php
class StripeGateway implements PaymentGatewayInterface
{
    public function charge(float $amount): bool
    {
        return Stripe::charges()->create(['amount' => $amount * 100]);
    }
}

// app/Repositories/OrderRepository.php
class OrderRepository implements OrderRepositoryInterface
{
    public function create(array $data): Order
    {
        return Order::create($data);
    }
}

// app/Services/EmailNotificationService.php
class EmailNotificationService implements NotificationInterface
{
    public function notify(Order $order): void
    {
        Mail::to($order->user->email)->send(new OrderPlaced($order));
    }
}

// app/Services/OrderService.php
class OrderService
{
    public function __construct(
        private OrderRepositoryInterface $orderRepository,
        private PaymentGatewayInterface $paymentGateway,
        private NotificationInterface $notificationService
    ) {}

    public function processOrder(array $orderData): Order
    {
        // Process payment
        $paymentSuccess = $this->paymentGateway->charge($orderData['total']);

        if (!$paymentSuccess) {
            throw new PaymentFailedException();
        }

        // Create order
        $order = $this->orderRepository->create($orderData);

        // Send notification
        $this->notificationService->notify($order);

        return $order;
    }
}

// app/Http/Controllers/OrderController.php
class OrderController extends Controller
{
    public function __construct(
        private OrderService $orderService
    ) {}

    public function store(StoreOrderRequest $request)
    {
        try {
            $order = $this->orderService->processOrder($request->validated());
            return new OrderResource($order);
        } catch (PaymentFailedException $e) {
            return response()->json(['error' => 'Payment failed'], 422);
        }
    }
}

// app/Providers/AppServiceProvider.php
public function register()
{
    $this->app->bind(
        PaymentGatewayInterface::class,
        StripeGateway::class
    );

    $this->app->bind(
        OrderRepositoryInterface::class,
        OrderRepository::class
    );

    $this->app->bind(
        NotificationInterface::class,
        EmailNotificationService::class
    );
}
```

---

## Laravel-Specific SOLID Benefits

### 1. **Testability**
```php
// tests/Unit/OrderServiceTest.php
class OrderServiceTest extends TestCase
{
    public function test_order_creation()
    {
        $mockRepo = Mockery::mock(OrderRepositoryInterface::class);
        $mockPayment = Mockery::mock(PaymentGatewayInterface::class);
        $mockNotification = Mockery::mock(NotificationInterface::class);

        $mockPayment->shouldReceive('charge')->andReturn(true);
        $mockRepo->shouldReceive('create')->andReturn(new Order());
        $mockNotification->shouldReceive('notify')->once();

        $service = new OrderService($mockRepo, $mockPayment, $mockNotification);
        $order = $service->processOrder(['total' => 100]);

        $this->assertInstanceOf(Order::class, $order);
    }
}
```

### 2. **Service Provider Binding**
```php
// Easy to swap implementations
$this->app->bind(PaymentGatewayInterface::class, function ($app) {
    return config('app.env') === 'testing'
        ? new FakePaymentGateway()
        : new StripeGateway();
});
```

### 3. **Dependency Injection**
```php
// Laravel automatically resolves dependencies
Route::post('/orders', [OrderController::class, 'store']);
// OrderController dependencies are auto-injected
```

---

## Summary

| Principle | Laravel Implementation | Benefit |
|-----------|----------------------|---------|
| **SRP** | Controllers, Services, Repositories, Requests | Clean, maintainable code |
| **OCP** | Interfaces, Service Providers | Easy to extend |
| **LSP** | Proper interface design | Reliable polymorphism |
| **ISP** | Small, focused interfaces | Flexible implementations |
| **DIP** | Dependency Injection, Contracts | Testable, loosely coupled |

## Best Practices

1. Use **Form Requests** for validation (SRP)
2. Create **Service classes** for business logic (SRP)
3. Use **Repositories** for data access (SRP, DIP)
4. Define **Interfaces/Contracts** for dependencies (DIP, OCP)
5. Bind interfaces in **Service Providers** (DIP)
6. Use **Resource classes** for API responses (SRP)
7. Leverage **Laravel's IoC container** for dependency injection (DIP)