<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{

    protected $commands = [
        Commands\QrcodeAccessTokenChange::class,
        Commands\UserCheckinUpdate::class,
        Commands\UpdateStreak::class,
        Commands\TennisStreak::class,
        Commands\UserAttendance::class,
        Commands\Testt::class,
    ];
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('QrcodeAccessTokenChange:update')->everyThirtyMinutes();
        $schedule->command('TennisStreak:update')->dailyAt('00:00');
        $schedule->command('StreakUpdate:update')->dailyAt('00:00');
        $schedule->command('UserCheckinUpdate:Update')->dailyAt('17:00');
        // $schedule->command('UserAttendance:update')->dailyAt('00:00');
        $schedule->command('UserAttendance:update')->everyMinute();
        // $schedule->command('UserCheckinUpdate:Update')->everyMinute();
        $schedule->command('command:test')->everyMinute();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
