<?php

use App\Models\Permission;

return [
    'administrator' => [
        'name' => 'Administrator',
        'description' => 'The Administrator has by default all available permissions.',
        'permissions' => [
            ...Permission::ALL,
        ],
    ],
];
