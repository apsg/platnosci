<?php
namespace App\Domains\Payments;

use App\Domains\Payments\Models\Order;

abstract class AbstractPaymentsDriver
{
    public abstract function forOrder(Order $order): self;

    public abstract function getUrl(): string;
}
