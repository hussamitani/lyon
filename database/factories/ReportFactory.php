<?php

namespace Database\Factories;

use App\Models\Patient;
use App\Models\Report;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Report>
 */
class ReportFactory extends Factory
{
    protected $model = Report::class;

    public function definition(): array
    {
        $faker = \Faker\Factory::create();
        $faker->addProvider(new \DavidBadura\FakerMarkdownGenerator\FakerProvider($faker));

        return [
            'subject' => fake()->realText(25),
            'diagnosis' => $faker->markdown(),
            'treatment' => $faker->markdown(),
        ];
    }

    public function configure(): Factory|InquiryFactory
    {
        return $this->afterMaking(function (Report $report) {
            if (! $report->patient_id) {
                $report->patient_id = Patient::all()->random()->id;
            }
            if (! $report->created_by_id) {
                $report->created_by_id = User::all()->random()->id;
            }
        });
    }
}
