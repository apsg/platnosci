<?php
namespace App\Console\Commands;

use App\Domains\Actions\Jobs\AccessJob;
use App\Domains\Payments\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FixQueueOrdersCommand extends Command
{
    protected $signature = 'orders:fix {date?}';

    public function handle()
    {
        $date = $this->argument('date') ?? $this->ask('Starting date');
        $fromDate = Carbon::parse($date)->startOfDay();

        $orders = Order::whereNotNull('confirmed_at')
            ->where('confirmed_at', '>', $fromDate)
            ->with('sale.actions')
            ->get();

        $this->info("Fixing {$orders->count()} orders");

        /** @var Order $order */
        foreach ($orders as $order) {
            foreach ($order->sale->actions as $action) {
                if ($action->job !== AccessJob::class) {
                    continue;
                }

                try {
                    dispatch(new AccessJob($order, $action->parameters));
                } catch (\Exception $exception) {
                    $this->error("Order: {$order->id}, action: {$action->id}");
                    $this->error($exception->getMessage());
                }
            }
        }

        $this->info('Fixed');
    }
}
