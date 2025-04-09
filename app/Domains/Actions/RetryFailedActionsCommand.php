<?php
namespace App\Domains\Actions;

use App\Domains\Actions\Models\Action;
use App\Domains\Payments\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class RetryFailedActionsCommand extends Command
{
    protected $signature = 'actions:retry-failed';

    protected $description = 'Retry failed actions';

    public function __invoke(): void
    {
        $orders = Order::paid()
            ->hasFailedActions()
            ->with('sale.actions')
            ->where('confirmed_at', '>=', now()->subHours(12))
            ->where('confirmed_at', '<', now()->subMinutes(20))
            ->get();

        /** @var Order $order */
        foreach ($orders as $order) {
            /** @var Action $action */
            foreach ($order->sale->actions as $action) {
                try {
                    $this->retryAction($action, $order);
                } catch (\Exception $exception) {
                    Log::error('Failed to retry action: ' . $action->id . ' for order: ' . $order->id);
                    Log::error($exception->getMessage());
                }
            }
        }
    }

    private function retryAction(Action $action, Order $order): void
    {
        call_user_func(
            $action->job . '::dispatchSync',
            $order,
            $action->parameters
        );
    }
}
