<?php

namespace App\Policies;

use App\Models\InquiryResponse;
use App\Models\Permission;
use App\Models\User;

class InquiryResponsePolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->hasPermission(Permission::PDMS_VIEW_INQUIRY_RESPONSE);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(Permission::PDMS_VIEW_INQUIRY_RESPONSE);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->hasPermission(Permission::PDMS_MANAGE_INQUIRY_RESPONSE);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(Permission::PDMS_MANAGE_INQUIRY_RESPONSE);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(Permission::PDMS_DELETE_INQUIRY_RESPONSE);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(Permission::PDMS_DELETE_INQUIRY_RESPONSE);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InquiryResponse $inquiryResponse): bool
    {
        return $user->hasPermission(Permission::PDMS_DELETE_INQUIRY_RESPONSE);
    }
}
