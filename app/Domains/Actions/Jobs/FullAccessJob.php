<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Integrations\Access\AccessProvider;

class FullAccessJob extends ActionJob
{
    public function handle(): void
    {
        $email = $this->order->email;

        AccessProvider::make($this->provider())
            ->grantFullAccess($email);

        $this->incrementActionsCount();
    }
}
