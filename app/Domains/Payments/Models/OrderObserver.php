<?php
namespace App\Domains\Payments\Models;

use Illuminate\Support\Str;

class OrderObserver
{
    public function creating(Order $order)
    {
        if (!empty($order->hash)) {
            return;
        }

        $order->fill([
            'hash' => Str::lower(Str::random(16)),
        ]);
    }
}
