---
---

# **Mix of deep technical, architectural and scenario bases questions.**

1. **Core PHP knowledge (depth & fundamentals)**
2. **System design & architecture** (scalability, maintainability, best practices)
3. **Framework experience (e.g., Symfony, Laravel, Zend, Yii)**
4. **Database design & optimization**
5. **API design & integration**
6. **DevOps & cloud (if relevant, like AWS, Docker, CI/CD)**
7. **Team leadership & mentoring** (since you’re senior)

Here’s a structured list of possible questions for a 2-hour round:

---

### **1. PHP Core (20–30 mins)**

- Explain how PHP handles request lifecycle.
- How does PHP memory management (zval, garbage collection) work?
- Difference between `==` and `===` in PHP, and pitfalls.
- How PHP handles sessions internally.
- Error handling strategies (`try-catch`, error handler, logging).
- Explain `spl_autoload_register()` and how Composer autoloading works.
- How do generators (`yield`) improve performance in PHP?
- Difference between interfaces, abstract classes, and traits.

---

### **2. Frameworks & OOP Design (20–25 mins)**

- How would you design a multi-tenant application in Symfony/Laravel?
- How do you structure service classes, repositories, and controllers?
- What are Dependency Injection containers, and why do frameworks use them?
- Event-driven architecture in PHP frameworks (listeners, subscribers).
- How do you handle middleware pipelines?

---

### **3. Database & Performance (20–25 mins)**

- How would you optimize a slow SQL query?
- Difference between indexing strategies (BTREE vs HASH).
- How do you handle DB migrations in production?
- How to design a scalable schema for millions of users?
- Connection pooling strategies in PHP (PDO, persistent connections).
- Caching strategies (Redis, Memcached, Doctrine Cache).

---

### **4. API Design & System Integration (15–20 mins)**

- How do you design a REST API vs GraphQL?
- Best practices for authentication (JWT, OAuth2, API tokens).
- How do you secure APIs against replay attacks, CSRF, XSS?
- Versioning APIs — how to handle breaking changes?
- Example: "How would you build an API that can handle 10k concurrent requests?"

---

### **5. Scalability & Architecture (20–25 mins)**

- Monolith vs SOA vs Microservices — trade-offs in PHP.
- How do you break a monolith PHP app into services?
- How would you implement event queues in PHP (e.g., RabbitMQ, Kafka, SQS)?
- Horizontal scaling vs vertical scaling — which works better with PHP?
- How do you handle background jobs in PHP (e.g., Symfony Messenger, Laravel Queues)?

---

### **6. DevOps, CI/CD & Cloud (15–20 mins)**

- How do you containerize a PHP app (Docker best practices)?
- PHP with AWS — which services have you used (S3, RDS, ECS, Lambda)?
- CI/CD pipelines for PHP (GitHub Actions, GitLab CI, Jenkins).
- Zero-downtime deployment strategies.
- How to manage secrets & environment configs in production?

---

### **7. Leadership & Problem Solving (15–20 mins)**

- Tell me about a time you led a PHP migration (e.g., PHP 5 → 8).
- How do you mentor juniors on clean code and best practices?
- How do you manage code reviews in large teams?
- Conflict resolution in technical decisions.
- Example: "Your team is pushing code with too many bugs. How do you handle it?"

---

✅ **Tips for 2-hour format**:

- Expect **coding + design exercise** (like building a mini API or refactoring code).
- Expect **system design whiteboard round** (e.g., "Design Uber backend in PHP").
- Expect **behavioral leadership questions** at the end.

---

---

# 📝 **Mock 2-Hour Interview Plan**

### **Part 1 – Warm-up & Background (10 mins)**

- Quick intro: “Tell me about your experience with PHP and large-scale systems.”
- Follow-up: “What’s the most technically challenging project you led, and why?”

---

### **Part 2 – Coding Exercise (30 mins)**

**Task A (Core PHP / OOP):**

- Write a class `CacheManager` with the following:

  - `set($key, $value, $ttl)`
  - `get($key)`
  - Internally, it should expire keys after TTL.
  - Optimize for memory usage (hint: generators, cleanup).

- Follow-up: Refactor it using **Dependency Injection** so it can switch between Redis / File cache easily.

**Task B (Refactoring / Best Practices):**

- Given some “bad” legacy PHP code, ask to:

  - Remove globals,
  - Add interfaces,
  - Write a unit test.

_(This checks coding clarity, OOP design, testing mindset.)_

---

### **Part 3 – System Design (30 mins)**

**Scenario:**
“Design a PHP-based backend for a ride-hailing app (like Uber).”

- Requirements:

  - Handle user registration & authentication.
  - Drivers share live locations.
  - Riders request rides, system matches driver → rider.
  - Handle 50k concurrent requests.

**Expected discussion points:**

- Monolith vs Microservices choice.
- How to design APIs (REST vs GraphQL).
- Database schema (users, rides, drivers, locations).
- Scaling strategy (load balancer, cache, queues).
- Real-time location updates (WebSocket, Redis pub/sub).
- Handling payment (idempotency, retries).

_(Checks architecture, scalability, and trade-off thinking.)_

---

### **Part 4 – Advanced PHP / Framework Knowledge (20 mins)**

Sample Questions:

- How does **Composer autoloading** work under the hood?
- When would you use **Traits vs Abstract Classes vs Interfaces**?
- What’s the difference between **Symfony Messenger** and **Laravel Queues**?
- How do you implement **event-driven architecture** in PHP?
- How do you migrate a large legacy PHP 5 app to PHP 8 with minimal downtime?

---

### **Part 5 – Database & Performance (15 mins)**

- You see a query taking 5s on production. Walk me through debugging it.
- How would you **design indexes** for a table with millions of rows?
- How would you design a **multi-tenant DB** in MySQL?
- How do you prevent **deadlocks** in high-traffic systems?

---

### **Part 6 – DevOps, Cloud & CI/CD (10 mins)**

- How do you deploy PHP apps with **zero downtime**?
- Walk me through a **Dockerized PHP app setup**.
- How would you implement **CI/CD pipeline** for a PHP + MySQL + Redis app?
- How do you handle **config/secrets** in cloud (AWS/GCP/Azure)?

---

### **Part 7 – Leadership & Team Fit (10–15 mins)**

- How do you mentor junior engineers in PHP best practices?
- Tell me about a time you had a **tech disagreement** with a senior engineer. How did you resolve it?
- How do you ensure **code quality** in large distributed teams?
- Example:
  _“Your team is rushing to meet deadlines and quality is slipping. As a lead, how do you handle it?”_

---

# ✅ **Summary of Time Breakdown**

- Intro / Background → 10 min
- Coding Exercise → 30 min
- System Design → 30 min
- Advanced PHP / Framework → 20 min
- Database / Performance → 15 min
- DevOps / Cloud → 10 min
- Leadership → 10–15 min

---

👉 This gives a **balanced 2-hour flow**: deep technical + practical coding + architectural thinking + leadership evaluation.

1. **Initial Problem (legacy code)** – messy code like you might see in production.
2. **Tasks** – what the interviewer will expect you to do.
3. **Refactored Solution** – how a senior should clean it up.
4. **Unit Test Example** – because at your level, testing is expected.

---

# 📝 **Coding Problem**

### **Legacy Code (what you’re given)**

```php
<?php
// legacy.php

function setCache($key, $value) {
    $GLOBALS['cache'][$key] = [
        'value' => $value,
        'expires' => time() + 60 // hardcoded TTL
    ];
}

function getCache($key) {
    if (isset($GLOBALS['cache'][$key])) {
        $item = $GLOBALS['cache'][$key];
        if ($item['expires'] > time()) {
            return $item['value'];
        } else {
            unset($GLOBALS['cache'][$key]); // expired
        }
    }
    return null;
}
```

---

# 🎯 **Tasks**

1. **Refactor this into a proper OOP class** (`CacheManager`).
2. Allow configurable TTL per entry.
3. Replace globals with **Dependency Injection** so we can swap storage (in-memory, Redis, file).
4. Write **Unit Tests** for the class.

---

# ✅ **Refactored Solution**

```php
<?php
// CacheInterface.php
interface CacheInterface {
    public function set(string $key, mixed $value, int $ttl): void;
    public function get(string $key): mixed;
    public function delete(string $key): void;
}
```

```php
<?php
// InMemoryCache.php
class InMemoryCache implements CacheInterface {
    private array $storage = [];

    public function set(string $key, mixed $value, int $ttl): void {
        $this->storage[$key] = [
            'value' => $value,
            'expires' => time() + $ttl
        ];
    }

    public function get(string $key): mixed {
        if (isset($this->storage[$key])) {
            $item = $this->storage[$key];
            if ($item['expires'] > time()) {
                return $item['value'];
            }
            $this->delete($key); // cleanup expired
        }
        return null;
    }

    public function delete(string $key): void {
        unset($this->storage[$key]);
    }
}
```

```php
<?php
// CacheManager.php
class CacheManager {
    public function __construct(private CacheInterface $driver) {}

    public function set(string $key, mixed $value, int $ttl = 60): void {
        $this->driver->set($key, $value, $ttl);
    }

    public function get(string $key): mixed {
        return $this->driver->get($key);
    }

    public function delete(string $key): void {
        $this->driver->delete($key);
    }
}
```

---

# 🧪 **Unit Test Example (PHPUnit)**

```php
<?php
use PHPUnit\Framework\TestCase;

class CacheManagerTest extends TestCase {
    public function testSetAndGetCache() {
        $cache = new InMemoryCache();
        $manager = new CacheManager($cache);

        $manager->set('foo', 'bar', 2);
        $this->assertEquals('bar', $manager->get('foo'));

        sleep(3); // let it expire
        $this->assertNull($manager->get('foo'));
    }

    public function testDeleteCache() {
        $cache = new InMemoryCache();
        $manager = new CacheManager($cache);

        $manager->set('foo', 'bar', 60);
        $manager->delete('foo');
        $this->assertNull($manager->get('foo'));
    }
}
```

---

# 💡 **Interviewer follow-up discussion**

- How would you swap **InMemoryCache** with **RedisCache**?
- How would you implement **LRU eviction** in memory cache?
- How to make this **thread-safe** in high concurrency (e.g., multiple PHP-FPM workers)?
- How would you test this without `sleep()` (use mocks)?

---

👉 Practicing this will **prepare you for real-world refactoring tasks**.
