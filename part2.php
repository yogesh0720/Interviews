Great 🚀 Let’s build a **realistic coding practice problem** that fits a **senior PHP engineer** level.
I’ll give you:

1. **Initial Problem (legacy code)** – messy code like you might see in production.
2. **Tasks** – what the interviewer will expect you to do.
3. **Refactored Solution** – how a senior should clean it up.
4. **Unit Test Example** – because at your level, testing is expected.

---

# 📝 **Coding Problem**

### **Legacy Code (what you’re given)**


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


---

# 🎯 **Tasks**

1. **Refactor this into a proper OOP class** (`CacheManager`).
2. Allow configurable TTL per entry.
3. Replace globals with **Dependency Injection** so we can swap storage (in-memory, Redis, file).
4. Write **Unit Tests** for the class.

---

# ✅ **Refactored Solution**



// CacheInterface.php
interface CacheInterface {
    public function set(string $key, mixed $value, int $ttl): void;
    public function get(string $key): mixed;
    public function delete(string $key): void;
}


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




# 🧪 **Unit Test Example (PHPUnit)**



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
---

# 💡 **Interviewer follow-up discussion**

* How would you swap **InMemoryCache** with **RedisCache**?
* How would you implement **LRU eviction** in memory cache?
* How to make this **thread-safe** in high concurrency (e.g., multiple PHP-FPM workers)?
* How would you test this without `sleep()` (use mocks)?

---

👉 Practicing this will **prepare you for real-world refactoring tasks**.

Do you want me to now create a **bigger system design case** (like the “Uber backend” example) with **expected architecture diagrams + trade-off answers** so you can practice Part 3?
