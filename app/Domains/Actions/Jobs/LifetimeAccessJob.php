<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Integrations\Access\AccessProvider;

class LifetimeAccessJob extends ActionJob
{
    public function handle(): void
    {
        $email = $this->order->email;

        AccessProvider::make($this->provider())
            ->grantFullLifetimeAccess($email);

        $this->incrementActionsCount();
    }
}
