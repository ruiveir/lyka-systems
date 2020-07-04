<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        Commands\PaymentStatus::class,
        Commands\AccountVerification::class
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('payment:update')
        ->hourly();

        $schedule->command('account:verification')
        ->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
