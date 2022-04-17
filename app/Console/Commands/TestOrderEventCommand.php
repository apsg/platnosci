<?php

namespace App\Console\Commands;

use App\Domains\Payments\Events\OrderConfirmedEvent;
use App\Domains\Payments\Models\Order;
use Illuminate\Console\Command;

class TestOrderEventCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:event';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $order = Order::first();
        event(new OrderConfirmedEvent($order));

        return 0;
    }
}
