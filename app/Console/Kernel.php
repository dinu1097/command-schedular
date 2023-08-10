<?php

namespace App\Console;

use App\Http\Controllers\CommandController;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{


    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            app(CommandController::class)->shootApiAndEmail();
        })->everyMinute()->sendOutputTo('/dev/null');
        // $schedule->call([CommandController::class, 'shootApiAndEmail'])->everyMinute();
        // ->everyFiveMinutes()    
    }
}
