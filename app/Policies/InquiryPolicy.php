<?php

namespace App\Policies;

use App\Enums\PermissionOption;
use App\Models\Inquiry;
use App\Models\User;

class InquiryPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_VIEW->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Inquiry $inquiry): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_VIEW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_CREATE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Inquiry $inquiry): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_UPDATE->value);
    }

    /**
     * Determine whether the user can delete any models.
     */
    public function deleteAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_DELETE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Inquiry $inquiry): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_DELETE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Inquiry $inquiry): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_FORCE_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_FORCE_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Inquiry $inquiry): bool
    {
        if (! $inquiry->deleted_at) {
            return false;
        }

        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_FORCE_DELETE->value);
    }
}
