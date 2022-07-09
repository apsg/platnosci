<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Actions\Models\Action;
use Illuminate\Support\Arr;
use MailerLiteApi\MailerLite;

class MailerliteJob extends ActionJob
{
    public function handle(): void
    {
        $token = config(
            'integrations.'
            . Action::ACTION_MAILERLITE
            . '.providers.'
            . $this->provider()
            . '.token'
        );
        $groupId = Arr::get($this->parameters, 'group_id');

        (new MailerLite($token))->groups()->addSubscriber($groupId, [
            'email' => $this->order->email,
        ]);
    }
}
