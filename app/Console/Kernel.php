<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\HelloWorld::class,
        \App\Console\Commands\CodeSniffer::class,
        \App\Console\Commands\FanGroups::class,
        \App\Console\Commands\AllFanGroup::class,
        \App\Console\Commands\Fans::class,
        \App\Console\Commands\FanDetails::class,
        \App\Console\Commands\AllFan::class,
        \App\Console\Commands\FanInfo::class,
                          ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('inspire')->hourly();
    }
}
