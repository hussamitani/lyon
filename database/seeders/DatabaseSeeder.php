<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create(['email' => 'admin@pim.com', 'name' => 'Administrator']);
        $user->roles()->attach(Role::where(['key' => 'administrator'])->first());
    }
}
