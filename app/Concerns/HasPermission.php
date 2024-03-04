<?php

namespace App\Concerns;

trait HasPermission
{
    public function hasPermission(string $permission): bool
    {
        return $this->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('id')
            ->contains($permission);
    }
}
