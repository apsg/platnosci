<?php
namespace App\Domains\Actions;

use App\Domains\Actions\Models\Action;
use App\Domains\Payments\Models\Order;
use Illuminate\Support\Arr;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;

class ActionsHelper
{
    public static function list(): Collection
    {
        return collect(config('integrations'))
            ->map(function (array $integration) {
                return Arr::get($integration, 'name');
            });
    }

    public static function isValidAction(string $action): bool
    {
        return array_key_exists($action, config('integrations'));
    }

    public static function getProviders(string $action): array
    {
        return array_keys(config("integrations.{$action}.providers", []));
    }

    public static function emailToName(string $email): string
    {
        return Str::studly(str_replace(['.', '-', '_'], [' '], explode('@', $email)[0]));
    }

    public static function retry(Action $action, Order $order): void
    {
        call_user_func(
            $action->job . '::dispatchSync',
            $order,
            $action->parameters
        );
    }
}
