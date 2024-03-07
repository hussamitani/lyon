<?php

namespace App\Jobs\Setup;

use App\Models\InquiryType;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateInquiryTypesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var array<string, mixed> $inquiry_types */
        $inquiry_types = config('setup.inquiry_types');

        collect($inquiry_types)->each(function (array $inquiry_type, string $key) {
            InquiryType::firstOrCreate([
                'key' => $key,
            ], [
                'name' => $inquiry_type['name'],
                'description' => $inquiry_type['description'],
            ]);
        });
    }
}
