<?php
namespace App\Domains\Payments\Repositories;

use App\Domains\Payments\Events\OrderCancelledEvent;
use App\Domains\Payments\Events\OrderConfirmedEvent;
use App\Domains\Payments\Models\Order;
use App\Domains\Sales\Models\Sale;
use Carbon\Carbon;
use Illuminate\Support\Str;

class OrdersRepository
{
    public function create(Sale $sale, string $email, ?string $phone = null) : Order
    {
        return Order::create([
            'sale_id' => $sale->id,
            'email'   => $email,
            'phone'   => $phone,
            'price'   => $sale->price,
            'hash'    => Str::random(16),
        ]);
    }

    public function findByHash(string $hash) : ?Order
    {
        return Order::where('hash', $hash)->first();
    }

    public function confirm(Order $order, string $externalId)
    {
        $order->update([
            'confirmed_at' => Carbon::now(),
            'external_id'  => $externalId,
        ]);

        event(new OrderConfirmedEvent($order));
    }

    public function cancel(Order $order)
    {
        $order->update([
            'cancelled_at' => Carbon::now(),
            'confirmed_at' => null,
        ]);

        event(new OrderCancelledEvent($order));
    }
}
