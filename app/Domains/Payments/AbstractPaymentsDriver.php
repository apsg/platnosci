<?php
namespace App\Domains\Payments;

use App\Domains\Payments\Models\Order;

abstract class AbstractPaymentsDriver
{
    abstract public function forOrder(Order $order): self;

    abstract public function getUrl(): string;
}
