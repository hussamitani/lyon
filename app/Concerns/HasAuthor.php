<?php

namespace App\Concerns;

use App\Models\User;
use Illuminate\Database\Eloquent\Relations\HasOne;

trait HasAuthor
{
    /**
     * @return HasOne<User>
     */
    public function createdBy(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id',
            'created_by_id',
        );
    }

    /**
     * @return HasOne<User>
     */
    public function updatedBy(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id',
            'updated_by_id',
        );
    }

    /**
     * @return HasOne<User>
     */
    public function deletedBy(): HasOne
    {
        return $this->hasOne(
            User::class,
            'id',
            'deleted_by_id',
        );
    }
}
