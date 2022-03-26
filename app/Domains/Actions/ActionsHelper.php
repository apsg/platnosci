<?php
namespace App\Domains\Actions;

use Illuminate\Support\Arr;
use Illuminate\Support\Collection;

class ActionsHelper
{
    public static function list() : Collection
    {
        return collect(config('integrations'))
            ->map(function (array $integration) {
                return Arr::get($integration, 'name');
            });
    }
}
