<?php

namespace App\Console\Commands;

use App\Jobs\Setup\CreatePermissionsJob;
use App\Jobs\Setup\CreateRolesJob;
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

        dispatch_sync(new CreateRolesJob());
        $this->info('Created default Roles');
    }
}
