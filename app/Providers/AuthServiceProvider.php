<?php

namespace App\Providers;

use App\Domains\Payments\Models\InvoiceRequest;
use App\Domains\Payments\Models\InvoiceRequestPolicy;
use App\Domains\Sales\Models\Sale;
use App\Domains\Sales\Models\SalePolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Sale::class           => SalePolicy::class,
        InvoiceRequest::class => InvoiceRequestPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
