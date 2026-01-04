<?php

$data = [
    "user1" => [
        "id" => 1,
        "name" => "Alice",
        "roles" => ["admin", "editor"],
        "profile" => [
            "email" => "alice@example.com",
            "address" => [
                "street" => "123 Maple Street",
                "city" => "New York",
                "contacts" => [
                    "home" => "555-1234",
                    "work" => "555-5678"
                ]
            ]
        ]
    ],
    "user2" => [
        "id" => 2,
        "name" => "Bob",
        "roles" => ["user"],
        "profile" => [
            "email" => "bob@example.com",
            "address" => [
                "street" => "456 Oak Avenue",
                "city" => "Los Angeles",
                "contacts" => [
                    "home" => "555-8765",
                    "mobile" => "555-4321"
                ]
            ]
        ]
    ]
];

function readArray($array, $prefix = '')
{
    foreach ($array as $key => $value) {
        // Build a readable key path
        $fullKey = $prefix === '' ? $key : $prefix . ' → ' . $key;

        if (is_array($value)) {
            // Recursive call if value is an array
            readArray($value, $fullKey);
        } else {
            echo "Key: $fullKey | Value: $value\n";
        }
    }
}
readArray($data);


# Output:
// Key: user1 → id | Value: 1
// Key: user1 → name | Value: Alice
// Key: user1 → roles → 0 | Value: admin
// Key: user1 → roles → 1 | Value: editor
// Key: user1 → profile → email | Value: alice@example.com
// Key: user1 → profile → address → street | Value: 123 Maple Street
// Key: user1 → profile → address → city | Value: New York
// Key: user1 → profile → address → contacts → home | Value: 555-1234
// Key: user1 → profile → address → contacts → work | Value: 555-5678

// Key: user2 → id | Value: 2
// Key: user2 → name | Value: Bob
// Key: user2 → roles → 0 | Value: user
// Key: user2 → profile → email | Value: bob@example.com
// Key: user2 → profile → address → street | Value: 456 Oak Avenue
// Key: user2 → profile → address → city | Value: Los Angeles
// Key: user2 → profile → address → contacts → home | Value: 555-8765
// Key: user2 → profile → address → contacts → mobile | Value: 555-4321
