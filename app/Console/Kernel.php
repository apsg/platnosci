<?php

namespace App\Console;

use App\Console\Commands\FixQueueOrdersCommand;
use App\Console\Commands\TestOrderEventCommand;
use App\Console\Commands\TestQueueCommand;
use App\Domains\Invoices\Console\InvoiceCredentialsTestCommand;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
        TestQueueCommand::class,
        TestOrderEventCommand::class,
        FixQueueOrdersCommand::class,
        InvoiceCredentialsTestCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
