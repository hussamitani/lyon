<?php

namespace App\Jobs\Setup;

use App\Models\AppointmentType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateAppointmentTypesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var array<string, mixed> $appointment_types */
        $appointment_types = config('setup.appointment_types');

        collect($appointment_types)->each(function (array $appointment_type, string $key) {
            AppointmentType::firstOrCreate([
                'key' => $key,
            ], [
                'name' => $appointment_type['name'],
                'description' => $appointment_type['description'],
            ]);
        });
    }
}
