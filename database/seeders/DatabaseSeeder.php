<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::factory()->create(['email' => 'admin@pdms.com', 'name' => 'Administrator']);
        $user->roles()->attach(Role::where(['key' => 'administrator'])->first());
        $this->call(PatientSeeder::class);
        $this->call(AppointmentSeeder::class);
        $this->call(ReportSeeder::class);
        $this->call(InquirySeeder::class);
        $this->call(InquiryResponseSeeder::class);
    }
}
