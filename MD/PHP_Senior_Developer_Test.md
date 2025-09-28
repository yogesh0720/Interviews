# PHP Senior Developer Test

---

## Section 1: Questions

### 1. Recursion

Write a recursive function in PHP to calculate the factorial of a number.

---

### 2. String Handling

Write a PHP function to count the number of vowels in a given string (case insensitive).

---

### 3. Array Functions

Given an array of integers, write a PHP function to remove duplicates without using loops (only array functions).

---

### 4. Database Knowledge

Write a prepared statement in PHP (PDO) to fetch all users from a table `users` where `status = 'active'`, and explain why prepared statements are safer than concatenating SQL strings.

---

### 5. OOP Autoloading Basics

Explain how **PSR-4 autoloading** works in PHP. Write a simple example of `spl_autoload_register` to load classes automatically.

---

## Section 2: Answers

### 1. Recursion – Factorial

```php
function factorial($n) {
    if ($n <= 1) return 1;
    return $n * factorial($n - 1);
}
echo factorial(5); // 120
```

---

### 2. String Handling – Count Vowels

```php
function countVowels($str) {
    preg_match_all('/[aeiou]/i', $str, $matches);
    return count($matches[0]);
}
echo countVowels("Hello World"); // 3
```

---

### 3. Array Functions – Remove Duplicates

```php
$numbers = [1, 2, 2, 3, 4, 4, 5];
$unique = array_values(array_unique($numbers));
print_r($unique);
```

---

### 4. Database Knowledge – PDO Prepared Statement

```php
$pdo = new PDO("mysql:host=localhost;dbname=testdb", "user", "pass");
$stmt = $pdo->prepare("SELECT * FROM users WHERE status = :status");
$stmt->execute(['status' => 'active']);
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
```

Prepared statements prevent **SQL Injection** by binding parameters safely instead of string concatenation.

---

### 5. OOP Autoloading Basics

```php
spl_autoload_register(function ($class) {
    $file = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($file)) {
        require $file;
    }
});

// Example usage
$obj = new App\Models\User();
```

**PSR-4** standard maps namespace to directory structure automatically (e.g., `App\Models\User` → `src/Models/User.php`).

### UTF-8 Safe String Reverse

```php
function reverseUtf8String(string $str): string
{
    // Split into array of Unicode characters
    $chars = preg_split('//u', $str, -1, PREG_SPLIT_NO_EMPTY);
    return implode('', array_reverse($chars));
}

// Example
echo reverseUtf8String("नमस्ते") . PHP_EOL; // outputs ेत्समन
echo reverseUtf8String("你好世界") . PHP_EOL; // outputs 界世好你

```
