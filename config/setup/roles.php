<?php

use App\Models\Permission;

return [
    'administrator' => [
        'name' => '',
        'description' => '',
        'permissions' => [
            ...Permission::ALL,
        ],
    ],
];
