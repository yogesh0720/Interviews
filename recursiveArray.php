<?php
$data = [
    'user' => [
        'id' => 101,
        'name' => 'Alice', [
                'age' => 32,
                'sex' => 'M'
            ],
            [
                'mob' => 11132,
                'phome' => '1212121'
            ],
        'address' => [
            'street' => '123 Main St',
            'city' => 'Metropolis',
            'geo' => [
                'lat' => 45.678,
                'lng' => -123.456
            ]
        ]
    ],
    'active' => true
];

function recursiveWalk($array, $callback, $prefix = '') {
    foreach ($array as $key => $value) {
        $new_key = $prefix === '' ? $key : $prefix . '.' . $key;
        if (is_array($value)) {
            recursiveWalk($value, $callback, $new_key);
        } else {
            $callback($new_key, $value);
        }
    }
}

// Example usage:
recursiveWalk($data, function($key, $value) {
    echo "$key => $value\n";
});