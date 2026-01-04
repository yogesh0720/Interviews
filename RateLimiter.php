<?php

class RateLimiter
{
    private $storage = []; // In real-world, use Redis or Memcached
    private $limit = 100;
    private $window = 3600; // 1 hour

    public function allowRequest(string $userId): bool
    {
        $currentTime = time();

        if (!isset($this->storage[$userId])) {
            $this->storage[$userId] = ['count' => 1, 'start' => $currentTime];
            return true;
        }

        $data = $this->storage[$userId];

        // Reset window if time exceeded
        if ($currentTime - $data['start'] > $this->window) {
            $this->storage[$userId] = ['count' => 1, 'start' => $currentTime];
            return true;
        }

        // Check request count
        if ($data['count'] < $this->limit) {
            $this->storage[$userId]['count']++;
            return true;
        }

        return false; // Rate limit exceeded
    }
}

// Example Usage
$limiter = new RateLimiter();
$user = "user_123";

for ($i = 1; $i <= 105; $i++) {
    if ($limiter->allowRequest($user)) {
        echo "Request $i allowed\n";
    } else {
        echo "Request $i blocked (Rate limit exceeded) for this {$user}\n";
    }
}
