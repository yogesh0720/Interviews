---
# 🕑 2-Hour PHP Principal Consultant Mock Interview
---

## **Section 1: Core PHP & OOP (30 min)**

**Q1.** Explain the differences between PHP 7.x and PHP 8.x. Which features have the biggest impact on enterprise projects?
**Expected A:** JIT compiler (performance gains), union types, attributes (annotations), nullsafe operator, match expression, weak maps, improved type safety. Impact → cleaner code, fewer runtime errors, better performance.

**Q2.** How does PHP’s garbage collection work?
**Expected A:** PHP uses **reference counting** with a cycle collector. Each variable has a zval with refcount. When count reaches zero → memory freed. Cyclic references (e.g., objects referencing each other) → handled by cycle collector.

**Q3.** Explain with example the difference between `interface`, `abstract class`, and `trait`. When would you use each?
**Expected A:**

- Interface → contract only.
- Abstract → partial implementation.
- Trait → horizontal code reuse.
  Use interface for polymorphism, abstract when common base logic exists, trait for mixins.

**Q4.** What is OpCache and how does it improve PHP performance?
**Expected A:** Caches compiled bytecode in memory. Eliminates recompilation overhead. Needs tuning (`opcache.memory_consumption`, `opcache.validate_timestamps`).

---

## **Section 2: Design & Architecture (30 min)**

**Q5.** Design a **multi-tenant SaaS CRM system** in PHP.

- How will you handle tenant isolation (DB-per-tenant vs shared DB with tenant_id)?
- How to scale horizontally?
- Where to store sessions?

**Expected A:**

- Choose per-tenant DB for strong isolation or shared DB with tenant_id for cost efficiency.
- Stateless app servers behind load balancer.
- Sessions in Redis/Memcached.
- Use queues for async tasks.
- API-first architecture.

**Q6.** How would you migrate a 200k LOC legacy PHP monolith (built in PHP 5.6) to modern PHP 8 with minimal downtime?
**Expected A:**

- Step-by-step upgrade: PHPStan static analysis, unit tests.
- Introduce Composer + autoloading.
- Refactor to services gradually.
- Containerize (Docker).
- Use strangler pattern → replace modules gradually with new services.

**Q7.** You’re asked to design a **rate-limiting API middleware in PHP**. How would you implement it?
**Expected A:**

- Use Redis with counters & TTL.
- For each request → increment counter per API key or IP.
- If count > limit → block request.
- Algorithms: token bucket, sliding window.

---

## **Section 3: Coding Exercise (30 min)**

_(You’d be asked to write working code, whiteboard, or pair-program)_

**Q8.** Write a PHP class implementing the **Strategy pattern** for different payment methods (`PayPal`, `Stripe`, `CashOnDelivery`).

✅ Example skeleton (expected from candidate):

```php
<?php

interface PaymentStrategy {
    public function pay(float $amount): string;
}

class PayPalPayment implements PaymentStrategy {
    public function pay(float $amount): string {
        return "Paid $amount using PayPal";
    }
}

class StripePayment implements PaymentStrategy {
    public function pay(float $amount): string {
        return "Paid $amount using Stripe";
    }
}

class CODPayment implements PaymentStrategy {
    public function pay(float $amount): string {
        return "Paid $amount using Cash on Delivery";
    }
}

class PaymentContext {
    private PaymentStrategy $strategy;

    public function __construct(PaymentStrategy $strategy) {
        $this->strategy = $strategy;
    }

    public function processPayment(float $amount): string {
        return $this->strategy->pay($amount);
    }
}

// Example usage
$context = new PaymentContext(new StripePayment());
echo $context->processPayment(200.00);
```

---

## **Section 4: Database & Performance (15 min)**

**Q9.** A PHP API using MySQL becomes slow when querying a table with 50M rows. How would you debug and optimize?
**Expected A:**

- Use `EXPLAIN` to check indexes.
- Add proper indexes (BTREE, composite).
- Use pagination with indexed fields, not OFFSET.
- Partitioning or sharding for very large datasets.
- Caching frequently accessed queries in Redis.

**Q10.** How would you design a system to support **10,000+ concurrent users** in PHP?
**Expected A:**

- Stateless application servers (PHP-FPM/Nginx).
- Horizontal scaling behind load balancer.
- Sessions → Redis or DB cluster.
- Cache → Redis/Memcached.
- DB replication for reads.
- Queue processing for async jobs.
- CDN for static files.

---

## **Section 5: Security & Testing (15 min)**

**Q11.** What are the top 5 PHP security risks and how do you mitigate them?
**Expected A:**

- SQL Injection → use prepared statements.
- XSS → escape output, CSP headers.
- CSRF → tokens in forms.
- File upload attacks → validate MIME, store outside webroot.
- Session hijacking → HttpOnly, Secure cookies, regenerate session IDs.

**Q12.** How do you enforce quality in a large PHP project?
**Expected A:**

- CI/CD pipeline with PHPUnit tests.
- Static analysis with PHPStan/Psalm.
- CodeSniffer for coding standards (PSR-12).
- Peer code reviews.
- SonarQube for maintainability.

---

# ✅ Wrap-up

- Expect **deep discussions on architecture, scalability, and modernization of PHP projects**.
- **Hands-on coding** (patterns, API design, optimization).
- **Leadership mindset**: how you mentor juniors, enforce best practices, and drive modernization.

---
