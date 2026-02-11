# SOLID Principles - PHP Examples

Complete implementation of all 5 SOLID principles with practical examples.

## Files Overview

### 1. Single Responsibility Principle (SRP)

**File:** `1_single_responsibility.php`

- Each class has one reason to change
- Separates User, UserRepository, and EmailService
- **Run:** `php 1_single_responsibility.php`

### 2. Open/Closed Principle (OCP)

**File:** `2_open_closed.php`

- Open for extension, closed for modification
- Payment methods using polymorphism
- **Run:** `php 2_open_closed.php`

### 3. Liskov Substitution Principle (LSP)

**File:** `3_liskov_substitution.php`

- Subtypes can replace parent types
- Proper Bird hierarchy (Flying vs Non-Flying)
- **Run:** `php 3_liskov_substitution.php`

### 4. Interface Segregation Principle (ISP)

**File:** `4_interface_segregation.php`

- Small, focused interfaces
- Printer, Scanner, Fax separated
- **Run:** `php 4_interface_segregation.php`

### 5. Dependency Inversion Principle (DIP)

**File:** `5_dependency_inversion.php`

- Depend on abstractions, not concrete classes
- Database abstraction with MySQL/PostgreSQL
- **Run:** `php 5_dependency_inversion.php`

### 6. Complete Example

**File:** `6_complete_example.php`

- All SOLID principles working together
- E-commerce order processing system
- **Run:** `php 6_complete_example.php`

## Quick Summary

| Principle | Key Concept                  | Benefit               |
| --------- | ---------------------------- | --------------------- |
| **S**RP   | One responsibility per class | Easy to maintain      |
| **O**CP   | Extend without modifying     | Safe to add features  |
| **L**SP   | Subtypes behave like parent  | Reliable polymorphism |
| **I**SP   | Small, focused interfaces    | Clean implementations |
| **D**IP   | Depend on abstractions       | Loose coupling        |

## Running Examples

```bash
# Run individual examples
php SOLID/1_single_responsibility.php
php SOLID/2_open_closed.php
php SOLID/3_liskov_substitution.php
php SOLID/4_interface_segregation.php
php SOLID/5_dependency_inversion.php

# Run complete example
php SOLID/6_complete_example.php
```

## When to Use SOLID

- **SRP**: When classes become too complex
- **OCP**: When adding new features frequently
- **LSP**: When designing inheritance hierarchies
- **ISP**: When interfaces become bloated
- **DIP**: When building testable, scalable systems
