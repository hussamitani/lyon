<?php

return [
    'administrator' => [
        'name' => 'Administrator',
        'description' => 'The Administrator has by default all available permissions.',
        'permissions' => [
            ...\App\Enums\PermissionOption::cases(),
        ],
    ],
];
