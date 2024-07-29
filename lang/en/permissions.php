<?php

use App\Enums\PermissionOption;

return [
    PermissionOption::ADMIN_USER_VIEW->value => [
        'name' => 'Admin | View users',
        'description' => 'Allows the user to view user accounts in the admin panel.',
    ],
    PermissionOption::ADMIN_USER_CREATE->value => [
        'name' => 'Admin | Create users',
        'description' => 'Allows the user to view user accounts in the admin panel.',
    ],
    PermissionOption::ADMIN_USER_UPDATE->value => [
        'name' => 'Admin | Update users',
        'description' => 'Allows the user to update user accounts in the admin panel.',
    ],
    PermissionOption::ADMIN_USER_DELETE->value => [
        'name' => 'Admin | Delete users',
        'description' => 'Allows the user to delete user accounts from the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_VIEW->value => [
        'name' => 'Admin | View roles',
        'description' => 'Allows the user to view roles defined in the system in the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_CREATE->value => [
        'name' => 'Admin | Create roles',
        'description' => 'Allows the user to create roles in the system in the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_UPDATE->value => [
        'name' => 'Admin | Update roles',
        'description' => 'Allows the user to update roles defined in the system in the admin panel.',
    ],
    PermissionOption::ADMIN_ROLE_DELETE->value => [
        'name' => 'Admin | Delete roles',
        'description' => 'Allows the user to delete roles defined in the system from the admin panel.',
    ],
    PermissionOption::ADMIN_PERMISSION_VIEW->value => [
        'name' => 'Admin | View permissions',
        'description' => 'Allows the user to view permissions assigned to roles in the admin panel.',
    ],
];
