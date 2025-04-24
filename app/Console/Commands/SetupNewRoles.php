<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schema;

class SetupNewRoles extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'setup:new-roles';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Setup batch advisor and semester coordinator roles';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Setting up new roles: Batch Advisor and Semester Coordinator');

        // Check if migrations have already been run
        if (Schema::hasTable('batch_advisors') && Schema::hasTable('semester_coordinators')) {
            $this->warn('Migration tables already exist. Skipping migration.');
        } else {
            // Run migrations for batch advisors and semester coordinators
            $this->info('Running migrations...');
            Artisan::call('migrate');
            $this->info('Migrations completed.');
        }

        $this->info('Setup completed successfully!');
        $this->info('You can now create batch advisors and semester coordinators from the admin panel.');
        
        return Command::SUCCESS;
    }
}
