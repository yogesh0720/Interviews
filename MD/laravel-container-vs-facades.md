# Laravel Service Container vs Facades

Complete guide to understanding the difference between Service Container and Facades in Laravel.

---

## What is Service Container?

The **Service Container** is Laravel's powerful tool for managing class dependencies and performing dependency injection. It's the core of Laravel's architecture.

### Key Features:
- Dependency injection
- Automatic resolution
- Binding interfaces to implementations
- Singleton management
- Contextual binding

---

## What are Facades?

**Facades** provide a static interface to classes available in the Service Container. They act as "static proxies" to underlying classes.

### Key Features:
- Static-like syntax
- Easy to use
- Testable
- Access to container services

---

## Key Differences

| Feature | Service Container | Facades |
|---------|------------------|---------|
| **Syntax** | Dependency Injection | Static methods |
| **Usage** | Constructor/Method injection | `Facade::method()` |
| **Testability** | Easy to mock | Easy to mock (with helpers) |
| **Flexibility** | More explicit | More convenient |
| **Type Hinting** | Yes | No (IDE helpers needed) |
| **Performance** | Slightly faster | Minimal overhead |

---

## 1. Service Container Examples

### Basic Binding and Resolving

```php
// app/Services/PaymentService.php
class PaymentService
{
    public function process($amount)
    {
        return "Processing payment: $amount";
    }
}

// Binding in Service Provider
// app/Providers/AppServiceProvider.php
public function register()
{
    // Simple binding
    $this->app->bind('payment', function ($app) {
        return new PaymentService();
    });

    // Singleton binding (same instance every time)
    $this->app->singleton('payment.processor', function ($app) {
        return new PaymentService();
    });
}

// Resolving from container
// Method 1: Using app() helper
$payment = app('payment');
$payment->process(100);

// Method 2: Using resolve() helper
$payment = resolve(PaymentService::class);

// Method 3: Using App facade
$payment = App::make('payment');
```

### Dependency Injection (Service Container)

```php
// app/Services/OrderService.php
class OrderService
{
    private $paymentService;
    private $notificationService;

    // Dependencies injected via constructor
    public function __construct(
        PaymentService $paymentService,
        NotificationService $notificationService
    ) {
        $this->paymentService = $paymentService;
        $this->notificationService = $notificationService;
    }

    public function createOrder($data)
    {
        $payment = $this->paymentService->process($data['amount']);
        $this->notificationService->send('Order created');
        return $payment;
    }
}

// app/Http/Controllers/OrderController.php
class OrderController extends Controller
{
    private $orderService;

    // Laravel automatically resolves dependencies
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function store(Request $request)
    {
        $order = $this->orderService->createOrder($request->all());
        return response()->json($order);
    }
}
```

### Interface Binding (Service Container)

```php
// app/Contracts/PaymentGatewayInterface.php
interface PaymentGatewayInterface
{
    public function charge($amount);
}

// app/Services/StripePayment.php
class StripePayment implements PaymentGatewayInterface
{
    public function charge($amount)
    {
        return "Stripe charged: $amount";
    }
}

// app/Services/PayPalPayment.php
class PayPalPayment implements PaymentGatewayInterface
{
    public function charge($amount)
    {
        return "PayPal charged: $amount";
    }
}

// Binding in Service Provider
public function register()
{
    // Bind interface to implementation
    $this->app->bind(
        PaymentGatewayInterface::class,
        StripePayment::class
    );

    // Conditional binding
    $this->app->bind(PaymentGatewayInterface::class, function ($app) {
        if (config('payment.gateway') === 'paypal') {
            return new PayPalPayment();
        }
        return new StripePayment();
    });
}

// Usage with dependency injection
class CheckoutService
{
    public function __construct(
        private PaymentGatewayInterface $gateway
    ) {}

    public function checkout($amount)
    {
        return $this->gateway->charge($amount);
    }
}
```

### Contextual Binding (Service Container)

```php
// Different implementations for different contexts
public function register()
{
    // When OrderController needs PaymentGatewayInterface, use Stripe
    $this->app->when(OrderController::class)
        ->needs(PaymentGatewayInterface::class)
        ->give(StripePayment::class);

    // When SubscriptionController needs PaymentGatewayInterface, use PayPal
    $this->app->when(SubscriptionController::class)
        ->needs(PaymentGatewayInterface::class)
        ->give(PayPalPayment::class);
}
```

---

## 2. Facades Examples

### Using Built-in Facades

```php
// app/Http/Controllers/UserController.php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    public function store(Request $request)
    {
        // Using DB Facade
        $user = DB::table('users')->insert([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        // Using Cache Facade
        Cache::put('user_' . $user->id, $user, 3600);

        // Using Mail Facade
        Mail::to($user->email)->send(new WelcomeEmail($user));

        // Using Log Facade
        Log::info('User created', ['user_id' => $user->id]);

        return response()->json($user);
    }

    public function show($id)
    {
        // Cache with Facade
        $user = Cache::remember('user_' . $id, 3600, function () use ($id) {
            return DB::table('users')->find($id);
        });

        return response()->json($user);
    }
}
```

### Creating Custom Facade

```php
// Step 1: Create the service class
// app/Services/PaymentService.php
class PaymentService
{
    public function process($amount)
    {
        return "Processing: $amount";
    }

    public function refund($transactionId)
    {
        return "Refunding: $transactionId";
    }
}

// Step 2: Register in Service Provider
// app/Providers/AppServiceProvider.php
public function register()
{
    $this->app->singleton('payment', function ($app) {
        return new PaymentService();
    });
}

// Step 3: Create Facade class
// app/Facades/Payment.php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class Payment extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'payment'; // Service container binding name
    }
}

// Step 4: Add alias in config/app.php (optional)
'aliases' => [
    'Payment' => App\Facades\Payment::class,
],

// Step 5: Use the custom facade
use App\Facades\Payment;

class OrderController extends Controller
{
    public function process()
    {
        $result = Payment::process(100);
        return response()->json(['result' => $result]);
    }

    public function refund($id)
    {
        $result = Payment::refund($id);
        return response()->json(['result' => $result]);
    }
}
```

---

## 3. Service Container vs Facades - Side by Side

### Example 1: Database Operations

```php
// Using Service Container (Dependency Injection)
class UserRepository
{
    public function __construct(
        private DatabaseManager $db
    ) {}

    public function find($id)
    {
        return $this->db->table('users')->find($id);
    }
}

// Using Facade
use Illuminate\Support\Facades\DB;

class UserRepository
{
    public function find($id)
    {
        return DB::table('users')->find($id);
    }
}
```

### Example 2: Caching

```php
// Using Service Container
class ProductService
{
    public function __construct(
        private CacheManager $cache
    ) {}

    public function getProduct($id)
    {
        return $this->cache->remember("product_$id", 3600, function () use ($id) {
            return Product::find($id);
        });
    }
}

// Using Facade
use Illuminate\Support\Facades\Cache;

class ProductService
{
    public function getProduct($id)
    {
        return Cache::remember("product_$id", 3600, function () use ($id) {
            return Product::find($id);
        });
    }
}
```

### Example 3: Email Sending

```php
// Using Service Container
use Illuminate\Mail\Mailer;

class NotificationService
{
    public function __construct(
        private Mailer $mailer
    ) {}

    public function sendWelcome($user)
    {
        $this->mailer->to($user->email)->send(new WelcomeEmail($user));
    }
}

// Using Facade
use Illuminate\Support\Facades\Mail;

class NotificationService
{
    public function sendWelcome($user)
    {
        Mail::to($user->email)->send(new WelcomeEmail($user));
    }
}
```

---

## 4. Testing Differences

### Testing with Service Container

```php
// tests/Unit/OrderServiceTest.php
use Tests\TestCase;
use App\Services\OrderService;
use App\Contracts\PaymentGatewayInterface;
use Mockery;

class OrderServiceTest extends TestCase
{
    public function test_order_creation()
    {
        // Mock the dependency
        $mockGateway = Mockery::mock(PaymentGatewayInterface::class);
        $mockGateway->shouldReceive('charge')
            ->once()
            ->with(100)
            ->andReturn(true);

        // Bind mock to container
        $this->app->instance(PaymentGatewayInterface::class, $mockGateway);

        // Test the service
        $service = app(OrderService::class);
        $result = $service->createOrder(['amount' => 100]);

        $this->assertTrue($result);
    }
}
```

### Testing with Facades

```php
// tests/Unit/UserControllerTest.php
use Tests\TestCase;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Cache;

class UserControllerTest extends TestCase
{
    public function test_user_creation()
    {
        // Fake the facades
        Mail::fake();
        Cache::fake();

        // Make request
        $response = $this->post('/users', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        // Assert mail was sent
        Mail::assertSent(WelcomeEmail::class);

        // Assert cache was set
        Cache::assertHas('user_1');

        $response->assertStatus(201);
    }
}
```

---

## 5. When to Use What?

### Use Service Container When:

✅ **Building testable applications**
```php
// Easy to mock dependencies
public function __construct(PaymentGateway $gateway) {}
```

✅ **Following SOLID principles**
```php
// Dependency Inversion Principle
interface PaymentGateway {}
class StripeGateway implements PaymentGateway {}
```

✅ **Need type hinting and IDE support**
```php
// Full IDE autocomplete
public function __construct(UserRepository $repo) {}
```

✅ **Complex dependency graphs**
```php
// Container resolves entire dependency tree
class OrderService {
    public function __construct(
        PaymentService $payment,
        NotificationService $notification,
        InventoryService $inventory
    ) {}
}
```

### Use Facades When:

✅ **Quick prototyping**
```php
Cache::put('key', 'value');
```

✅ **Simple operations**
```php
Log::info('Something happened');
```

✅ **Working with Laravel's built-in services**
```php
DB::table('users')->get();
Mail::to($user)->send($email);
```

✅ **Cleaner syntax in simple cases**
```php
// Instead of injecting Request everywhere
request()->input('name');
```

---

## 6. Real-World Complete Example

```php
// Using Service Container (Recommended for complex logic)
// app/Services/OrderProcessingService.php
class OrderProcessingService
{
    public function __construct(
        private OrderRepository $orderRepo,
        private PaymentGatewayInterface $paymentGateway,
        private InventoryService $inventory,
        private NotificationService $notification
    ) {}

    public function processOrder(array $data): Order
    {
        // All dependencies injected and testable
        $order = $this->orderRepo->create($data);
        $this->paymentGateway->charge($data['amount']);
        $this->inventory->reserve($data['items']);
        $this->notification->sendConfirmation($order);

        return $order;
    }
}

// Using Facades (Good for simple operations)
// app/Http/Controllers/DashboardController.php
use Illuminate\Support\Facades\{DB, Cache, Auth};

class DashboardController extends Controller
{
    public function index()
    {
        $userId = Auth::id();

        $stats = Cache::remember("dashboard_$userId", 3600, function () {
            return [
                'orders' => DB::table('orders')->count(),
                'revenue' => DB::table('orders')->sum('total'),
                'customers' => DB::table('users')->count(),
            ];
        });

        return view('dashboard', compact('stats'));
    }
}
```

---

## Summary

| Aspect | Service Container | Facades |
|--------|------------------|---------|
| **Best For** | Complex business logic | Simple operations |
| **Testability** | Explicit mocking | Fake methods |
| **Type Safety** | Full type hinting | No type hints |
| **Flexibility** | High | Medium |
| **Learning Curve** | Steeper | Easier |
| **Code Clarity** | More verbose | More concise |
| **SOLID Principles** | ✅ Follows | ⚠️ Can violate |

## Best Practice

**Combine both approaches:**
- Use **Service Container** for business logic and services
- Use **Facades** for quick operations and Laravel's built-in features
- Always prefer **Dependency Injection** in testable code
- Use **Facades** for convenience in controllers and simple operations