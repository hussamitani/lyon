<?php

namespace App\Jobs\Setup;

use App\Models\InquiryStatus;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateInquiryStatusesJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        /** @var array<string, mixed> $inquiry_statuses */
        $inquiry_statuses = config('setup.inquiry_statuses');

        collect($inquiry_statuses)->each(function (array $inquiry_status, string $key) {
            InquiryStatus::firstOrCreate([
                'key' => $key,
            ], [
                'status' => $inquiry_status['status'],
                'status_category' => $inquiry_status['status_category'],
                'description' => $inquiry_status['description'],
            ]);
        });
    }
}
