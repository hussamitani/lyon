<?php

namespace App\Enums;

enum PermissionEnum: string
{
    case ADMIN_USER_VIEW = 'admin_user_view';
    case ADMIN_USER_CREATE = 'admin_user_create';
    case ADMIN_USER_UPDATE = 'admin_user_update';
    case ADMIN_USER_DELETE = 'admin_user_delete';

    case ADMIN_ROLE_VIEW = 'admin_role_view';
    case ADMIN_ROLE_CREATE = 'admin_role_create';
    case ADMIN_ROLE_UPDATE = 'admin_role_update';
    case ADMIN_ROLE_DELETE = 'admin_role_delete';

    case ADMIN_PERMISSION_VIEW = 'admin_permission_view';
}
