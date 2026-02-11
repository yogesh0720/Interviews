# Symfony PHP: Handling 1M+ Requests Per Day

## Is It Possible? YES!

**1 million requests per day = ~11.6 requests per second**
This is very achievable with proper architecture and optimization.

## Real-World Examples

### Companies Using Symfony at Scale:
- **Spotify** - Music streaming platform
- **BlaBlaCar** - Ride-sharing platform
- **Trivago** - Hotel booking platform
- **Dailymotion** - Video platform

## How to Achieve High Performance

### 1. Application-Level Optimizations

```php
<?php
// config/packages/framework.yaml
framework:
    cache:
        app: cache.adapter.redis
        default_redis_provider: redis://localhost:6379
    
    # Enable HTTP cache
    http_cache: true
    
    # Optimize serializer
    serializer:
        enable_annotations: false
        mapping:
            paths: ['%kernel.project_dir%/config/serialization']

// Optimized Controller
class ApiController extends AbstractController
{
    #[Route('/api/users/{id}', methods: ['GET'])]
    #[Cache(expires: '+1 hour', public: true)]
    public function getUser(int $id, UserRepository $repo): JsonResponse
    {
        $user = $repo->findCached($id); // Redis cache
        return $this->json($user);
    }
}
```

### 2. Database Optimization

```php
<?php
// Doctrine optimizations
// config/packages/doctrine.yaml
doctrine:
    dbal:
        connections:
            default:
                # Connection pooling
                server_version: '8.0'
                charset: utf8mb4
                options:
                    1002: 'SET sql_mode=(SELECT REPLACE(@@sql_mode,\'ONLY_FULL_GROUP_BY\',\'\'))'
    orm:
        # Query result cache
        result_cache_driver:
            type: redis
            host: localhost
            port: 6379
        # Metadata cache
        metadata_cache_driver:
            type: redis

// Repository with caching
class UserRepository extends ServiceEntityRepository
{
    public function findCached(int $id): ?User
    {
        return $this->cache->get("user_$id", function() use ($id) {
            return $this->find($id);
        });
    }
}
```

### 3. Infrastructure Setup

```yaml
# docker-compose.yml for scalable setup
version: '3.8'
services:
  nginx:
    image: nginx:alpine
    ports:
      - "80:80"
    volumes:
      - ./nginx.conf:/etc/nginx/nginx.conf
  
  php-fpm:
    image: php:8.2-fpm
    deploy:
      replicas: 4  # Multiple PHP-FPM processes
    volumes:
      - ./app:/var/www/html
  
  redis:
    image: redis:alpine
    command: redis-server --maxmemory 256mb
  
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: secret
    command: --innodb-buffer-pool-size=1G
```

### 4. Nginx Configuration

```nginx
# nginx.conf - Optimized for high traffic
upstream php-fpm {
    server php-fpm1:9000 weight=1;
    server php-fpm2:9000 weight=1;
    server php-fpm3:9000 weight=1;
    server php-fpm4:9000 weight=1;
}

server {
    listen 80;
    root /var/www/html/public;
    
    # Static file caching
    location ~* \.(js|css|png|jpg|jpeg|gif|ico|svg)$ {
        expires 1y;
        add_header Cache-Control "public, immutable";
    }
    
    # PHP-FPM with caching
    location ~ ^/index\.php(/|$) {
        fastcgi_pass php-fpm;
        fastcgi_cache_valid 200 1h;
        fastcgi_cache_key "$scheme$request_method$host$request_uri";
    }
}
```

## Performance Benchmarks

### Single Server Capacity:
- **Basic Setup**: 50-100 RPS
- **Optimized Setup**: 500-1000 RPS
- **With Caching**: 2000+ RPS

### Load Distribution:
```
1M requests/day = 11.6 RPS average
Peak hours (20% of traffic): ~58 RPS
With 4 servers: ~15 RPS per server
```

## Key Optimization Strategies

### 1. Caching Layers
```php
<?php
// Multi-level caching
class ProductService
{
    public function getProduct(int $id): Product
    {
        // L1: APCu (in-memory)
        if ($product = apcu_fetch("product_$id")) {
            return $product;
        }
        
        // L2: Redis (shared cache)
        if ($product = $this->redis->get("product_$id")) {
            apcu_store("product_$id", $product, 300);
            return $product;
        }
        
        // L3: Database
        $product = $this->repository->find($id);
        $this->redis->setex("product_$id", 3600, $product);
        apcu_store("product_$id", $product, 300);
        
        return $product;
    }
}
```

### 2. Database Connection Pooling
```php
<?php
// config/packages/doctrine.yaml
doctrine:
    dbal:
        connections:
            default:
                # Connection pooling
                pool_size: 20
                max_connections: 100
                # Read replicas
            read:
                host: '%env(DB_READ_HOST)%'
                replica: true
```

### 3. Async Processing
```php
<?php
// Using Symfony Messenger for async tasks
class OrderController extends AbstractController
{
    #[Route('/orders', methods: ['POST'])]
    public function createOrder(Request $request, MessageBusInterface $bus): JsonResponse
    {
        $order = new Order($request->getContent());
        
        // Sync: Save order
        $this->entityManager->persist($order);
        $this->entityManager->flush();
        
        // Async: Send email, update inventory
        $bus->dispatch(new SendOrderConfirmation($order->getId()));
        $bus->dispatch(new UpdateInventory($order->getItems()));
        
        return $this->json(['id' => $order->getId()], 201);
    }
}
```

## AWS Architecture Example

```yaml
# AWS infrastructure for 1M+ requests/day
Load Balancer (ALB):
  - Health checks
  - SSL termination
  - Request distribution

Auto Scaling Group:
  - Min: 2 instances
  - Max: 10 instances
  - Target: 70% CPU utilization

EC2 Instances:
  - Type: t3.medium or larger
  - PHP-FPM + Nginx
  - CloudWatch monitoring

RDS MySQL:
  - Multi-AZ deployment
  - Read replicas
  - Connection pooling

ElastiCache Redis:
  - Cluster mode
  - Automatic failover
  - Memory optimization

CloudFront CDN:
  - Static asset caching
  - API response caching
  - Global distribution
```

## Monitoring & Metrics

```php
<?php
// Performance monitoring
class PerformanceMiddleware
{
    public function process(Request $request, RequestHandler $handler): Response
    {
        $start = microtime(true);
        $response = $handler->handle($request);
        $duration = microtime(true) - $start;
        
        // Log slow requests
        if ($duration > 0.5) {
            $this->logger->warning('Slow request', [
                'uri' => $request->getUri(),
                'duration' => $duration
            ]);
        }
        
        return $response;
    }
}
```

## Conclusion

**1 million requests per day with Symfony is not only possible but routine** for many production applications. The key factors are:

1. **Proper caching strategy** (Redis, APCu, HTTP cache)
2. **Database optimization** (connection pooling, read replicas)
3. **Infrastructure scaling** (load balancers, auto-scaling)
4. **Code optimization** (efficient queries, minimal processing)
5. **Monitoring and profiling** (identifying bottlenecks)

Many companies successfully handle much higher loads (10M+ requests/day) with Symfony-based applications.