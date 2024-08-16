<?php

namespace App\Jobs\Setup;

use App\Models\Role;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateAdminJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function handle(): void
    {
        $admin = config('setup.admin');

        $user = User::create([
            'email' => $admin['email'],
            'name' => $admin['name'],
            'password' => bcrypt($admin['password']),
            'email_verified_at' => now(),
        ]);

        $user->roles()->attach(Role::where(['key' => 'administrator'])->first());
    }
}
