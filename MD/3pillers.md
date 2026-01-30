# Interview Questions & Answers – Full Stack (PHP / Laravel / JS / React / MySQL / Docker / HTML)

---

## PHP / Laravel

### 1. What is Late Static Binding in PHP?

Late Static Binding allows a child class to reference itself in static method calls using `static::` instead of `self::`.

```php
class ParentClass {
    public static function who() {
        echo "Parent";
    }

    public static function callWho() {
        static::who();
    }
}

class ChildClass extends ParentClass {
    public static function who() {
        echo "Child";
    }
}

ChildClass::callWho(); // Child
```

---

### 2. If 1 million jobs are pushed to a queue suddenly, how do you prevent system failure?

Key strategies:

- Control inflow (batching & delays)
- Queue isolation
- Safe worker scaling
- Idempotent jobs

```php
foreach (array_chunk($data, 1000) as $chunk) {
    ProcessChunk::dispatch($chunk)->delay(now()->addSeconds(2));
}
```

---

### 3. Service Container in Laravel

```php
interface PaymentGateway {
    public function pay();
}

class StripePayment implements PaymentGateway {
    public function pay() {
        return "Paid via Stripe";
    }
}

// AppServiceProvider
$this->app->bind(PaymentGateway::class, StripePayment::class);

class OrderController {
    public function __construct(private PaymentGateway $gateway) {}
}
```

---

### 4. Middleware Execution Order in Laravel

Order:

1. Global middleware
2. Middleware groups
3. Route middleware
4. Priority middleware

Wrong order can break:

- Authentication
- CSRF protection
- Authorization

---

### 5. How does Eloquent hydrate models?

```php
$rows = DB::select("SELECT * FROM users");
$users = User::hydrate($rows);
```

Eloquent converts raw DB rows into fully functional models.

---

## JavaScript

### 6. Closure in JavaScript

```js
function counter() {
  let count = 0;
  return function () {
    count++;
    console.log(count);
  };
}
```

---

### 7. Promise vs Promise.all

```js
Promise.all([fetchUser(), fetchOrders()]).then(([user, orders]) =>
  console.log(user, orders),
);
```

---

### 8. Async / Await

```js
async function loadData() {
  const user = await fetchUser();
  const orders = await fetchOrders();
}
```

---

## React JS

### 9. useMemo vs useCallback

```jsx
const filteredUsers = useMemo(() => users.filter((u) => u.active), [users]);

const handleClick = useCallback(() => {
  setCount((c) => c + 1);
}, []);
```

---

### 10. React Suspense

```jsx
const Dashboard = React.lazy(() => import("./Dashboard"));

<Suspense fallback={<Spinner />}>
  <Dashboard />
</Suspense>;
```

---

## MySQL

### 11. Update M to F and F to M

```sql
UPDATE users
SET gender = CASE
  WHEN gender = 'M' THEN 'F'
  WHEN gender = 'F' THEN 'M'
END;
```

---

### 12. Users who never ordered same product twice

```sql
SELECT u.id, u.name
FROM users u
JOIN orders o ON o.user_id = u.id
JOIN order_items oi ON oi.order_id = o.id
GROUP BY u.id, u.name
HAVING COUNT(*) = COUNT(DISTINCT oi.product_id);
```

---

### 13. Total Purchase Amount in Last 30 Days

```sql
SELECT SUM(total_amount)
FROM orders
WHERE created_at >= NOW() - INTERVAL 30 DAY;
```

---

## Docker

### 14. Docker Architecture Workflow

Dockerfile → Image → Container

---

### 15. Docker Image vs Container

- Image: Read-only template
- Container: Running instance of image

---

## HTML

### 16. Semantic Tags & SEO

Semantic tags:

```html
<header>
  ,
  <nav>
    ,
    <article>
      ,
      <section>
        ,
        <footer></footer>
      </section>
    </article>
  </nav>
</header>
```

Benefits:

- Better SEO
- Better accessibility
- Clear structure
