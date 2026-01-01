<?php
namespace App\Domains\Actions;

use App\Domains\Actions\Models\Action;
use App\Domains\Payments\Models\Order;
use App\Domains\Sales\Models\Sale;
use Illuminate\Console\Command;

class RetryActionCommand extends Command
{
    protected $signature = 'action:retry {sale?}';

    public function __invoke(): void
    {
        $saleId = $this->argument('sale') ?? $this->ask('Sale ID?');

        /** @var Sale $sale */
        $sale = Sale::find($saleId);

        if ($sale === null) {
            $this->error('No such sale');

            return;
        }

        $choices = $sale->actions->mapWithKeys(function (Action $action) {
            return [
                (string)$action->id => $action->job . '({' . json_encode($action->parameters) . '})',
            ];
        })->toArray();

        $actionId = array_search($this->choice(
            'Which action to retry?',
            $choices
        ), $choices);

        $action = Action::find($actionId);

        if ($action === null) {
            $this->error('No such action');

            return;
        }

        $useForAll = $this->confirm('Retry for all orders?');

        if ($useForAll === true) {
            $this->retryForAll($sale, $action);

            return;
        }

        $choices = $sale->orders->mapWithKeys(function (Order $order) {
            return [
                $order->id => $order->email,
            ];
        })->toArray();

        $orderId = array_search($this->choice(
            'Which order to retry?',
            $choices
        ), $choices);

        $this->retrySingle(Order::find($orderId), $action);
    }

    private function retryForAll(Sale $sale, Action $action): void
    {
        foreach ($sale->orders as $order) {
            $this->retrySingle($order, $action);
        }
    }

    private function retrySingle(Order $order, Action $action): void
    {
        $this->info("Retrying action {$action->job} for user {$order->email}");

        call_user_func(
            $action->job . '::dispatchSync',
            $order,
            $action->parameters
        );
    }
}
