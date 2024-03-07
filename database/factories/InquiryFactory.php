<?php

namespace Database\Factories;

use App\Models\Inquiry;
use App\Models\InquiryType;
use App\Models\Patient;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Inquiry>
 */
class InquiryFactory extends Factory
{
    protected $model = Inquiry::class;

    public function definition(): array
    {
        return [
            'subject' => fake()->realText(25),
            'description' => fake()->realText(),
        ];
    }

    public function configure(): Factory|InquiryFactory
    {
        return $this->afterMaking(function (Inquiry $inquiry) {
            if (! $inquiry->patient_id) {
                $inquiry->patient_id = Patient::all()->random()->id;
            }
            if (! $inquiry->type_id) {
                $inquiry->type_id = InquiryType::all()->random()->id;
            }
            if (! $inquiry->created_by_id) {
                $inquiry->created_by_id = User::all()->random()->id;
            }
        });
    }
}
