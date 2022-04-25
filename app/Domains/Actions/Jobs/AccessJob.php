<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Integrations\Access\AccessProvider;
use Illuminate\Support\Arr;

class AccessJob extends ActionJob
{
    public function handle() : void
    {
        $provider = Arr::get($this->parameters, 'provider');
        $courseId = Arr::get($this->parameters, 'course_id');
        $email = $this->order->email;

        AccessProvider::make($provider)
            ->grantAccess($email, $courseId);
    }
}
