<?php

namespace App\Console\Commands;

use App\Jobs\Setup\CreateAppointmentTypesJob;
use App\Jobs\Setup\CreateInquiryStatusesJob;
use App\Jobs\Setup\CreateInquiryTypesJob;
use App\Jobs\Setup\CreatePermissionsJob;
use Illuminate\Console\Command;

class SetupCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:setup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        dispatch_sync(new CreatePermissionsJob());
        $this->info('Created Permissions');

        dispatch_sync(new CreateAppointmentTypesJob());
        $this->info('Created Appointment types');

        dispatch_sync(new CreateInquiryStatusesJob());
        $this->info('Created Inquiry Statuses');

        dispatch_sync(new CreateInquiryTypesJob());
        $this->info('Created Inquiry Types');
    }
}
