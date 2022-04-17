<?php
namespace App\Providers;

use App\Domains\Payments\Events\OrderConfirmedEvent;
use App\Domains\Sales\Models\Sale;
use App\Domains\Sales\Models\SalesObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class          => [
            SendEmailVerificationNotification::class,
        ],
        OrderConfirmedEvent::class => [

        ],
    ];

    public function boot()
    {
        Sale::observe(SalesObserver::class);
    }
}
