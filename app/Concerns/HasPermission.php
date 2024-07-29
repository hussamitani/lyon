<?php

namespace App\Concerns;

trait HasPermission
{
    public function hasPermission(string $permission): bool
    {
        return $this->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('key')
            ->contains($permission) ||
        $this->permissions->pluck('key')->contains($permission);
    }

    /**
     * @param  array<string>  $permissions
     */
    public function hasAnyPermission(array $permissions): bool
    {
        $userPermissions = $this->roles
            ->pluck('permissions')
            ->flatten()
            ->pluck('key')->merge($this->permissions->pluck('key'))->unique();

        foreach ($permissions as $permission) {
            if ($userPermissions->contains($permission)) {
                return true;
            }
        }

        return false;
    }
}
