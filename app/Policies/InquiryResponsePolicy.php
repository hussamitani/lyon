<?php

namespace App\Policies;

use App\Enums\PermissionOption;
use App\Models\InquiryResponse;
use App\Models\User;

class InquiryResponsePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_VIEW->value);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_VIEW->value);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_CREATE->value);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $inquiryResponse->createdBy->is($user) && $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_CREATE->value);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InquiryResponse $inquiryResponse): bool
    {
        if ($user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_FORCE_DELETE->value)) {
            return true;
        }

        return $inquiryResponse->createdBy->is($user) && $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_CREATE->value);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_FORCE_DELETE->value);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(PermissionOption::PDMS_INQUIRY_RESPONSE_FORCE_DELETE->value);
    }
}
