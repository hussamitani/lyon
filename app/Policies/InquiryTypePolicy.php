<?php

namespace App\Policies;

use App\Enums\PermissionOption;
use App\Models\InquiryType;
use App\Models\User;

class InquiryTypePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InquiryType $inquiryType): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InquiryType $inquiryType): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InquiryType $inquiryType): bool
    {
        if ($inquiryType->key) {
            return false;
        }

        if ($inquiryType->inquiries()->count()) {
            return false;
        }

        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InquiryType $inquiryType): bool
    {
        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InquiryType $inquiryType): bool
    {
        if ($inquiryType->key) {
            return false;
        }

        if ($inquiryType->inquiries()->count()) {
            return false;
        }

        return $user->hasPermission(PermissionOption::SYSTEM_INQUIRY_TYPE_MANAGE->value);
    }
}
