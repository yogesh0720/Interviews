# PHP Array Logical Problems (Senior Level)

## **1. Find Second Largest Number in Array**

**Problem:**  
Given an array `[10, 5, 20, 20, 8]`, find the **second largest number**.

**Solution:**

```php
<?php
class ArrayHelper {
    public static function secondLargest(array $arr): ?int {
        $unique = array_unique($arr);
        rsort($unique);
        return $unique[1] ?? null; // Return null if no second largest
    }
}

// Usage
$arr = [10, 5, 20, 20, 8];
echo ArrayHelper::secondLargest($arr); // 10
```

---

## **2. Merge Two Arrays Without Duplicates**

**Problem:**  
Merge `[1,2,3]` and `[2,3,4,5]` into one array **without duplicates**.

**Solution:**

```php
<?php
class ArrayHelper {
    public static function mergeUnique(array $a, array $b): array {
        return array_unique(array_merge($a, $b));
    }
}

// Usage
$a = [1,2,3];
$b = [2,3,4,5];
print_r(ArrayHelper::mergeUnique($a, $b));
// Output: [1,2,3,4,5]
```

---

## **3. Find Missing Numbers in a Sequence**

**Problem:**  
Find missing numbers in `[1, 2, 4, 6]` within range `[1..6]`.

**Solution:**

```php
<?php
class ArrayHelper {
    public static function missingNumbers(array $arr): array {
        $range = range(min($arr), max($arr));
        return array_values(array_diff($range, $arr));
    }
}

// Usage
$arr = [1,2,4,6];
print_r(ArrayHelper::missingNumbers($arr));
// Output: [3,5]
```

---

## **4. Group Array by Key**

**Problem:**  
Group people by `"role"`:

```php
$people = [
    ["name"=>"Alice", "role"=>"dev"],
    ["name"=>"Bob", "role"=>"manager"],
    ["name"=>"Charlie", "role"=>"dev"]
];
```

**Solution:**

```php
<?php
class ArrayHelper {
    public static function groupBy(array $arr, string $key): array {
        $result = [];
        foreach ($arr as $item) {
            $result[$item[$key]][] = $item;
        }
        return $result;
    }
}

// Usage
$grouped = ArrayHelper::groupBy($people, "role");
print_r($grouped);
```

---

## **5. Sliding Window Sum**

**Problem:**  
Calculate sum of each subarray of size 3 in `[1,2,3,4,5,6]`.

**Solution:**

```php
<?php
class ArrayHelper {
    public static function slidingWindowSum(array $arr, int $size): array {
        $result = [];
        $n = count($arr);
        for ($i=0; $i <= $n - $size; $i++) {
            $result[] = array_sum(array_slice($arr, $i, $size));
        }
        return $result;
    }
}

// Usage
$arr = [1,2,3,4,5,6];
print_r(ArrayHelper::slidingWindowSum($arr, 3));
// Output: [6,9,12,15]
```

---

✅ **Advantages of OOP Refactoring**

- Encapsulates array logic in a reusable class (`ArrayHelper`).
- Easy to extend with new methods (e.g., median, mode, rotate).
- Testable in unit tests.
