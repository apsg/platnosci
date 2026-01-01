<?php
namespace App\Providers;

use App\Domains\Payments\Events\DispatchSaleActionsListener;
use App\Domains\Payments\Events\OrderCancelledEvent;
use App\Domains\Payments\Events\OrderConfirmedEvent;
use App\Domains\Payments\Events\ResendOrderMailingEvent;
use App\Domains\Payments\Events\SendOrderEmailListener;
use App\Domains\Sales\Models\Sale;
use App\Domains\Sales\Models\SalesObserver;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        OrderConfirmedEvent::class => [
            SendOrderEmailListener::class,
            DispatchSaleActionsListener::class,
        ],
        OrderCancelledEvent::class => [
        ],
        ResendOrderMailingEvent::class => [
            SendOrderEmailListener::class,
        ],
    ];

    public function boot()
    {
        Sale::observe(SalesObserver::class);
    }
}
