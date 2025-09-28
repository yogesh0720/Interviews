📝 Mock 2-Hour Interview Plan
Part 1 – Warm-up & Background (10 mins)
* Quick intro: “Tell me about your experience with PHP and large-scale systems.”
* Follow-up: “What’s the most technically challenging project you led, and why?”

Part 2 – Coding Exercise (30 mins)
Task A (Core PHP / OOP):
* Write a class CacheManager with the following:
* set($key, $value, $ttl)
* get($key)
* Internally, it should expire keys after TTL.
* Optimize for memory usage (hint: generators, cleanup).
* Follow-up: Refactor it using Dependency Injection so it can switch between Redis / File cache easily.
Task B (Refactoring / Best Practices):
* Given some “bad” legacy PHP code, ask to:
* Remove globals,
* Add interfaces,
* Write a unit test.
(This checks coding clarity, OOP design, testing mindset.)

Part 3 – System Design (30 mins)
Scenario:“Design a PHP-based backend for a ride-hailing app (like Uber).”
* Requirements:
* Handle user registration & authentication.
* Drivers share live locations.
* Riders request rides, system matches driver → rider.
* Handle 50k concurrent requests.
Expected discussion points:
* Monolith vs Microservices choice.
* How to design APIs (REST vs GraphQL).
* Database schema (users, rides, drivers, locations).
* Scaling strategy (load balancer, cache, queues).
* Real-time location updates (WebSocket, Redis pub/sub).
* Handling payment (idempotency, retries).
(Checks architecture, scalability, and trade-off thinking.)

Part 4 – Advanced PHP / Framework Knowledge (20 mins)
Sample Questions:
* How does Composer autoloading work under the hood?
* When would you use Traits vs Abstract Classes vs Interfaces?
* What’s the difference between Symfony Messenger and Laravel Queues?
* How do you implement event-driven architecture in PHP?
* How do you migrate a large legacy PHP 5 app to PHP 8 with minimal downtime?

Part 5 – Database & Performance (15 mins)
* You see a query taking 5s on production. Walk me through debugging it.
* How would you design indexes for a table with millions of rows?
* How would you design a multi-tenant DB in MySQL?
* How do you prevent deadlocks in high-traffic systems?

Part 6 – DevOps, Cloud & CI/CD (10 mins)
* How do you deploy PHP apps with zero downtime?
* Walk me through a Dockerized PHP app setup.
* How would you implement CI/CD pipeline for a PHP + MySQL + Redis app?
* How do you handle config/secrets in cloud (AWS/GCP/Azure)?

Part 7 – Leadership & Team Fit (10–15 mins)
* How do you mentor junior engineers in PHP best practices?
* Tell me about a time you had a tech disagreement with a senior engineer. How did you resolve it?
* How do you ensure code quality in large distributed teams?
* Example:“Your team is rushing to meet deadlines and quality is slipping. As a lead, how do you handle it?”

✅ Summary of Time Breakdown
* Intro / Background → 10 min
* Coding Exercise → 30 min
* System Design → 30 min
* Advanced PHP / Framework → 20 min
* Database / Performance → 15 min
* DevOps / Cloud → 10 min
* Leadership → 10–15 min

👉 This gives a balanced 2-hour flow: deep technical + practical coding + architectural thinking + leadership evaluation.