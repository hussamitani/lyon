<?php

namespace App\Concerns;

use App\Models\Permission;

trait HasPermission
{
    public function hasPermission(Permission $permission): bool
    {
        return $this->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('id')
            ->contains($permission->id);
    }
}
