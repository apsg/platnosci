<?php
namespace App\Console\Commands;

use App\Domains\Actions\Jobs\MailerliteJob;
use App\Domains\Payments\Events\OrderConfirmedEvent;
use App\Domains\Payments\Models\Order;
use Illuminate\Console\Command;

class FixQueueOrdersCommand extends Command
{
    protected $signature = 'orders:fix';

    public function handle()
    {
        $orders = Order::whereNotNull('confirmed_at')
            ->whereHas('sale.actions', function ($q) {
                $q->where('job', MailerliteJob::class);
            })
            ->with('sale.actions')
            ->get();

        $this->info("Fixing {$orders->count()} orders");

        /** @var Order $order */
        foreach ($orders as $order) {
            foreach ($order->sale->actions as $action) {
                if ($action->job === MailerliteJob::class) {
                    dispatch(new MailerliteJob($order, $action->parameters));
                }
            }
        }

        $this->info("Fixed");
    }
}
