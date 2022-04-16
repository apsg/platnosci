<?php
namespace App\Domains\Payments\Events;

use App\Domains\Payments\Models\Order;

class OrderConfirmedEvent
{
    public Order $order;

    public function __construct(Order $order)
    {
        $this->order = $order;
    }
}
