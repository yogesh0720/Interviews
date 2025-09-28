# PHP Senior Engineer Interview Q&A (10–13 Years Experience)

This sheet contains **questions with sample answers** for senior-level PHP interviews.

---

## 1. Core PHP & Advanced Concepts

**Q:** Explain PHP memory management and garbage collection.  
**A:** PHP uses reference counting to track variables. When a variable’s reference count drops to zero, memory is freed. PHP also has a cyclic garbage collector to handle circular references (introduced in PHP 5.3).

**Q:** What are PHP streams and how can you implement a custom stream wrapper?  
**A:** PHP streams unify file, network, and memory I/O. A custom stream wrapper is created by implementing methods (`stream_open`, `stream_read`, etc.) in a class and registering it with `stream_wrapper_register()`.

**Q:** Difference between `require`, `include`, and autoloading.  
**A:** `require` stops execution on failure, `include` only raises a warning. Autoloading (via `spl_autoload_register` or Composer PSR-4) loads classes on demand instead of manual includes.

**Q:** How does `yield` improve performance compared to arrays?  
**A:** `yield` creates a generator, yielding values one by one without storing everything in memory. Useful for processing large datasets like CSVs.

---

## 2. String, Array & Data Handling

**Q:** Validate if a string with nested brackets (e.g., `{[()]}`) is balanced.  
**A:** Use a stack. Push opening brackets, pop when closing appears. If stack is empty at end → balanced.

**Q:** Find duplicates in a large array with millions of records. Optimize for memory.  
**A:** Use `array_count_values()` or a hash map. For memory efficiency, process data in chunks or use generators.

**Q:** How would you process a 5GB CSV file in PHP without exhausting memory?  
**A:** Open file with `fopen()`, read line by line with `fgetcsv()`. Combine with `yield` to process rows lazily.

---

## 3. Database & SQL

**Q:** How to prevent SQL injection in raw PDO queries?  
**A:** Use prepared statements with bound parameters:

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = :id");
$stmt->execute(['id' => $id]);
```

**Q:** Difference between `INNER JOIN`, `LEFT JOIN`, and `UNION`.  
**A:** `INNER JOIN`: only matching rows. `LEFT JOIN`: all from left table + matches. `UNION`: combine results from multiple queries (removes duplicates).

**Q:** Write SQL to fetch the 3rd highest salary, handling duplicates.

```sql
SELECT DISTINCT salary
FROM employees
ORDER BY salary DESC
LIMIT 1 OFFSET 2;
```

**Q:** Explain sharding and replication in MySQL.  
**A:** Sharding = splitting data across multiple DBs (horizontal partitioning). Replication = copying data from master to replicas for read scalability and redundancy.

---

## 4. OOP & Design Patterns

**Q:** Explain Dependency Injection vs Dependency Inversion in PHP.  
**A:** DI = passing dependencies via constructor/methods. DIP = design principle where high-level modules depend on abstractions, not concrete classes.

**Q:** How does PSR-4 autoloading work in Composer?  
**A:** Maps namespaces to file paths. Example: `App\User\Service` → `/src/User/Service.php`. Composer generates `vendor/autoload.php` to handle this.

**Q:** Which design patterns have you used (Factory, Observer, Strategy)?  
**A:** Example: Factory for object creation, Observer for event handling (pub-sub), Strategy for interchangeable algorithms.

**Q:** How would you refactor a legacy procedural app to OOP?  
**A:** Identify reusable logic, encapsulate into classes, introduce interfaces, apply SOLID principles, gradually replace procedural code with service classes.

---

## 5. Scalability & Performance

**Q:** How to optimize PHP apps for high traffic?  
**A:** Enable OPcache, use Redis/Memcached for caching, optimize SQL, CDN for assets, async queues for heavy jobs. Profile code with Xdebug/Blackfire.

**Q:** Horizontal vs vertical scaling in PHP apps.  
**A:** Vertical = add resources to one server. Horizontal = add more servers behind a load balancer. Horizontal is more scalable but complex.

**Q:** Implement real-time notifications: polling vs SSE vs WebSockets.  
**A:** Polling = periodic requests, SSE = one-way server push, WebSockets = full-duplex. Choose based on app needs.

**Q:** How do you handle background jobs in PHP?  
**A:** Use queues (RabbitMQ, Beanstalkd, Redis, SQS). Workers consume tasks asynchronously. Eg: sending emails, report generation.

---

## 6. Security

**Q:** How to prevent SQL Injection, XSS, CSRF, and Session Hijacking?  
**A:** SQLi → prepared statements. XSS → escape output. CSRF → use tokens. Session hijack → use `httponly` + `secure` cookies, regenerate IDs.

**Q:** Explain password hashing (`password_hash`, `password_verify`).  
**A:** `password_hash()` securely hashes with bcrypt/argon2. `password_verify()` checks input against hash. Built-in salt included.

**Q:** How do you securely store API keys in PHP apps?  
**A:** Store in `.env` files or environment variables. Never hardcode in source code. Use vault services for production.

---

## 7. System Design & Architecture

**Q:** How would you design a multi-tenant SaaS in PHP?  
**A:** Options: (a) Shared DB with tenant_id, (b) Schema per tenant, (c) Separate DB per tenant. Depends on isolation and scaling needs.

**Q:** Compare Monolith vs SOA vs Microservices in PHP.  
**A:** Monolith = simple but tightly coupled. SOA = services with loose coupling. Microservices = fully independent deployable units with APIs. Tradeoff: complexity vs flexibility.

**Q:** How to migrate a legacy PHP 5 app to PHP 8?  
**A:** Upgrade step-by-step: check deprecated functions, update libraries, write tests, ensure compatibility. Use tools like `phpcompatibility` sniffers.

**Q:** Explain event-driven architecture in PHP.  
**A:** System reacts to events asynchronously. Example: user registers → trigger email + analytics event. Implemented via queues, observers, or event buses.

---

## 8. Testing & Debugging

**Q:** How do you structure unit tests without PHPUnit installed?  
**A:** Write a lightweight custom TestCase class with `assertEquals`, `assertTrue`. Run test functions manually.

**Q:** How to mock a database in tests?  
**A:** Implement repository interfaces with in-memory/fake data classes. Inject fake repo into services.

**Q:** How would you debug memory leaks in PHP?  
**A:** Use `memory_get_usage()` to monitor. Xdebug/Blackfire to trace. Check for circular references, large arrays, unclosed file handles.

**Q:** Approach for load testing a PHP app.  
**A:** Use tools like Apache JMeter, Locust, or ab. Simulate concurrent users, monitor response times, tune DB queries, add caching.

---

End of document.
