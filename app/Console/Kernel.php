<?php
namespace App\Console;

use App\Console\Commands\FixQueueOrdersCommand;
use App\Console\Commands\TestOrderEventCommand;
use App\Console\Commands\TestQueueCommand;
use App\Domains\Actions\RetryActionCommand;
use App\Domains\Actions\RetryFailedActionsCommand;
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
        RetryActionCommand::class,
        RetryFailedActionsCommand::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command(RetryFailedActionsCommand::class)->everyTenMinutes();
    }

    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
