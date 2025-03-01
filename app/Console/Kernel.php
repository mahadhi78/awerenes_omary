<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Jobs\SendEmailJob;
class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        /*$schedule->command('queue:work')->everyMinute()->withoutOverlapping()
          ->appendOutputTo(storage_path().'/logs/laravel_schedule_output.log'); */ 
          //php /path/to/laravel/artisan queue:work --stop-when-empty

          $schedule->command('queue:listen --queue=default')->everyMinute()->withoutOverlapping()
          ->appendOutputTo(storage_path().'/logs/laravel_schedule_output.log'); 
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
