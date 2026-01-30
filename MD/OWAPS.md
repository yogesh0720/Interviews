# OWASP Top 10 (2021) – Real PHP Attack Examples & Fixes

This document covers **ALL OWASP Top 10 vulnerabilities**
with **real PHP examples**, attack payloads, and secure coding fixes.
Ideal for **interviews, audits, and secure PHP development**.

---

## A01: Broken Access Control

### ❌ Vulnerable PHP

```php
$user = getUserById($_GET['id']);
```

### 💥 Attack

```
profile.php?id=2
```

### ✅ Fix

```php
if ($_GET['id'] != $_SESSION['user_id']) {
    http_response_code(403);
    exit;
}
```

---

## A02: Cryptographic Failures (Sensitive Data Exposure)

### ❌ Vulnerable

```php
INSERT INTO users (password) VALUES ('$password');
```

### ✅ Fix

```php
$hash = password_hash($password, PASSWORD_BCRYPT);
```

---

## A03: Injection

### ❌ SQL Injection

```php
$sql = "SELECT * FROM users WHERE email='$email'";
```

### 💥 Attack

```
' OR 1=1 --
```

### ✅ Fix

```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email=?");
$stmt->execute([$email]);
```

---

## A04: Insecure Design

### ❌ Vulnerable Logic

```php
if ($_POST['code'] === 'ADMIN123') {
    $isAdmin = true;
}
```

### ✅ Fix

Use role-based access control and server-side validation.

---

## A05: Security Misconfiguration

### ❌ Vulnerable Config

```ini
display_errors = On
```

### ✅ Secure Config

```ini
display_errors = Off
log_errors = On
```

---

## A06: Vulnerable & Outdated Components

### ❌ Risk

Outdated PHP libraries with known CVEs

### ✅ Fix

```bash
composer update
composer audit
```

---

## A07: Identification & Authentication Failures

### ❌ Vulnerable

```php
if ($password === $row['password']) { login(); }
```

### ✅ Fix

```php
password_verify($password, $row['password']);
session_regenerate_id(true);
```

---

## A08: Software & Data Integrity Failures

### ❌ Insecure Deserialization

```php
$data = unserialize($_COOKIE['user']);
```

### ✅ Fix

```php
$data = json_decode($_COOKIE['user'], true);
```

---

## A09: Security Logging & Monitoring Failures

### ❌ Missing Logs

No logging of failed login attempts

### ✅ Fix

```php
error_log("Failed login attempt for $email");
```

---

## A10: Server-Side Request Forgery (SSRF)

### ❌ Vulnerable

```php
file_get_contents($_GET['url']);
```

### 💥 Attack

```
http://localhost:8080/admin
```

### ✅ Fix

```php
$allowedHosts = ['api.example.com'];
$host = parse_url($_GET['url'], PHP_URL_HOST);

if (!in_array($host, $allowedHosts)) {
    die('SSRF blocked');
}
```

---

## Bonus: Cross-Site Scripting (XSS)

### ❌ Vulnerable

```php
echo $_GET['name'];
```

### ✅ Fix

```php
echo htmlspecialchars($_GET['name'], ENT_QUOTES, 'UTF-8');
```

---

## Bonus: CSRF Protection

### ✅ CSRF Token Example

```php
if ($_POST['token'] !== $_SESSION['token']) {
    die('CSRF detected');
}
```

---

## Interview Gold Line 🏆

“In real PHP applications, most OWASP issues come from injection,
broken access control, insecure uploads, and bad configurations.”
