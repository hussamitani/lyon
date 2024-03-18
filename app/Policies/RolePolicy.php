<?php

namespace App\Policies;

use App\Enums\PermissionOption;
use App\Models\Role;
use App\Models\User;

class RolePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::ADMIN_ROLE_VIEW->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Role $role): bool
    {
        return $user->hasPermission(PermissionOption::ADMIN_ROLE_VIEW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionOption::ADMIN_ROLE_CREATE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Role $role): bool
    {
        return $user->hasPermission(PermissionOption::ADMIN_ROLE_UPDATE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Role $role): bool
    {
        if ($role->key) {
            return false;
        }

        if ($role->users()->count()) {
            return false;
        }

        return $user->hasPermission(PermissionOption::ADMIN_ROLE_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Role $role): bool
    {
        return $user->hasPermission(PermissionOption::ADMIN_ROLE_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Role $role): bool
    {
        if ($role->key) {
            return false;
        }

        return $user->hasPermission(PermissionOption::ADMIN_ROLE_DELETE->value);
    }
}
