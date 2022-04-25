<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Integrations\Access\AccessProvider;
use Illuminate\Support\Arr;

class AccessJob extends ActionJob
{
    public function handle() : void
    {
        $courseId = Arr::get($this->parameters, 'course_id');
        $email = $this->order->email;

        AccessProvider::make($this->provider())
            ->grantAccess($email, $courseId);
    }
}
