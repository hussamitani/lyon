<?php

namespace Database\Factories;

use App\Models\Inquiry;
use App\Models\InquiryResponse;
use App\Models\InquiryStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<InquiryResponse>
 */
class InquiryResponseFactory extends Factory
{
    protected $model = InquiryResponse::class;

    public function definition(): array
    {
        return [
            'message' => fake()->realText,
        ];
    }

    public function configure(): Factory|InquiryFactory
    {
        return $this->afterMaking(function (InquiryResponse $inquiry) {
            if (! $inquiry->inquiry_id) {
                $inquiry->inquiry_id = Inquiry::all()->random()->id;
            }
            if (! $inquiry->status_id) {
                $inquiry->status_id = InquiryStatus::all()->random()->id;
            }
            if (! $inquiry->created_by_id) {
                $inquiry->created_by_id = User::all()->random()->id;
            }
        });
    }
}
