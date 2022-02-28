<?php
namespace App\Providers;

use App\Domains\Payments\Models\PaymentRequest;
use App\Domains\Payments\Models\PaymentRequestObserver;
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
    ];

    public function boot()
    {
        PaymentRequest::observe(PaymentRequestObserver::class);
        Sale::observe(SalesObserver::class);
    }
}
