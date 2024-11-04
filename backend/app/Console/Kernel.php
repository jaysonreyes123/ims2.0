<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        // $schedule->command('inspire')->hourly();

        $schedule->call('App\Http\Controllers\API\DataController@insert_data')
            ->name('insert_data')
            ->withoutOverlapping();

        $schedule->call('App\Http\Controllers\API\WarningController@check_warning')
            ->name('check_warning')
            ->withoutOverlapping();
        
            // $schedule->call('App\Http\Controllers\API\DataController@sample')
            // ->name('sample')
            // ->withoutOverlapping()
            // ->everyTenSeconds();
        $schedule->command('queue:work --stop-when-empty')
        ->withoutOverlapping();
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
