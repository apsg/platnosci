<?php
namespace App\Domains\Payments\Repositories;

use App\Domains\Payments\Models\Order;
use App\Domains\Sales\Models\Sale;
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
}
