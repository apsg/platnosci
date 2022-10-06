<?php
namespace App\Console\Commands;

use App\Domains\Payments\Events\OrderConfirmedEvent;
use App\Domains\Payments\Models\Order;
use Illuminate\Console\Command;

class FixQueueOrdersCommand extends Command
{
    protected $signature = 'orders:fix';

    public function handle()
    {
        $orders = Order::whereNotNull('confirmed_at')->get();

        $this->info("Fixing {$orders->count()} orders");

        foreach ($orders as $order) {
            event(new OrderConfirmedEvent($order));
        }

        $this->info("Fixed");
    }
}
