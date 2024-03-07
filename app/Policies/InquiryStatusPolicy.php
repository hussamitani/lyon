<?php

namespace App\Policies;

use App\Models\InquiryStatus;
use App\Models\User;

class InquiryStatusPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, InquiryStatus $inquiryStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, InquiryStatus $inquiryStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, InquiryStatus $inquiryStatus): bool
    {
        if ($inquiryStatus->key) {
            return false;
        }

        return true;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, InquiryStatus $inquiryStatus): bool
    {
        return true;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, InquiryStatus $inquiryStatus): bool
    {
        return true;
    }
}
