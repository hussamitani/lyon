<?php

namespace App\Policies;

use App\Enums\PermissionOption;
use App\Models\AppointmentType;
use App\Models\User;

class AppointmentTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, AppointmentType $appointmentType): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, AppointmentType $appointmentType): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, AppointmentType $appointmentType): bool
    {
        if ($appointmentType->key) {
            return false;
        }

        if ($appointmentType->appointments()->count()) {
            return false;
        }

        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, AppointmentType $appointmentType): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, AppointmentType $appointmentType): bool
    {
        if ($appointmentType->key) {
            return false;
        }

        if ($appointmentType->appointments()->count()) {
            return false;
        }

        return $user->hasPermission(PermissionOption::SYSTEM_APPOINTMENT_TYPE_MANAGE->value);
    }
}
