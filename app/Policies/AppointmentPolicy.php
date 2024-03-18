<?php

namespace App\Policies;

use App\Enums\PermissionOption;
use App\Models\Appointment;
use App\Models\User;

class AppointmentPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_VIEW->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Appointment $appointment): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_VIEW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_CREATE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Appointment $appointment): bool
    {
        if ($appointment->deleted_at) {
            return false;
        }

        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_UPDATE->value);
    }

    /**
     * Determine whether the user can delete models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_DELETE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Appointment $appointment): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Appointment $appointment): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_FORCE_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete any models.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_FORCE_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Appointment $appointment): bool
    {
        if (! $appointment->deleted_at) {
            return false;
        }

        return $user->hasPermission(PermissionOption::PDMS_APPOINTMENT_FORCE_DELETE->value);
    }
}
