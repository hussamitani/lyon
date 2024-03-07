<?php

namespace Database\Factories;

use App\Models\Appointment;
use App\Models\AppointmentType;
use App\Models\Patient;
use App\Models\User;
use DateInterval;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        return [
            'subject' => fake()->realText(25),
            'description' => fake()->realText(),
            'location' => fake()->realText(),
            'begins_at' => $begins_at = fake()->dateTime(),
            'ends_at' => $begins_at->add(DateInterval::createFromDateString('2 hours')),
        ];
    }

    public function configure(): Factory|InquiryFactory
    {
        return $this->afterMaking(function (Appointment $appointment) {
            if (! $appointment->patient_id) {
                $appointment->patient_id = Patient::all()->random()->id;
            }
            if (! $appointment->type_id) {
                $appointment->type_id = AppointmentType::all()->random()->id;
            }
            if (! $appointment->created_by_id) {
                $appointment->created_by_id = User::all()->random()->id;
            }
        });
    }
}
