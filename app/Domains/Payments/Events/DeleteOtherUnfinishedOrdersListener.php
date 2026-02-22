<?php
namespace App\Domains\Payments\Events;

use App\Domains\Payments\Models\Order;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class DeleteOtherUnfinishedOrdersListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderConfirmedEvent $event)
    {
        $this->delete();

        $confirmedOrder = $event->order;

        Order::where('email', $confirmedOrder->email)
            ->where('sale_id', $confirmedOrder->sale_id)
            ->whereNull('confirmed_at')
            ->delete();
    }
}
