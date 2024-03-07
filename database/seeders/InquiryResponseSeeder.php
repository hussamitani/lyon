<?php

namespace Database\Seeders;

use App\Models\InquiryResponse;
use Illuminate\Database\Seeder;

class InquiryResponseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        InquiryResponse::factory()->count(1500)->create();
    }
}
