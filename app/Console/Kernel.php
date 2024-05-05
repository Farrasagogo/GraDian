<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected $commands = [
        'app\Console\Commands\DemoCron'
      
    ];
    protected function schedule(Schedule $schedule)
    {   
        
        $schedule->command('demo:cron')->hourly();
        $schedule->command('hapus:data')->daily();
        $schedule->command('schedule:obat')->everyMinute();


    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
