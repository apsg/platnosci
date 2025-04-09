<?php
namespace App\Domains\Actions;

use Illuminate\Console\Command;

class RetryFailedActionsCommand extends Command
{
    protected $signature = 'actions:retry-failed';

    protected $description = 'Retry failed actions';

    public function __invoke(): void
    {
        $actions = Action::where('status', 'failed')->get();
    }
}
