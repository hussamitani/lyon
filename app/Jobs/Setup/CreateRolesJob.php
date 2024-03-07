<?php

namespace App\Jobs\Setup;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateRolesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        /** @var array<string, mixed> $roles */
        $roles = config('setup.roles');

        collect($roles)->each(function (array $role, string $key) {
            $roleModel = Role::firstOrCreate([
                'key' => $key,
            ], [
                'name' => $role['name'],
                'description' => $role['description'],
            ]);

            $rolePermissions = Permission::whereIn('key', $role['permissions'])->pluck('id');
            $roleModel->permissions()->sync($rolePermissions);
        });
    }
}
