<?php
namespace App\Domains\Payments\Events;

use App\Domains\Actions\Models\Action;
use Exception;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;
use TypeError;

class DispatchSaleActionsListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(OrderConfirmedEvent $event)
    {
        if ($event->order === null || $event->order->sale === null) {
            return;
        }

        if (!$event->order->isPaid()) {
            return;
        }

        /** @var Action $action */
        foreach ($event->order->sale->actions as $action) {
            $jobClass = $action->job;
            try {
                dispatch(new $jobClass($event->order, $action->parameters));
            } catch (Exception $exception) {
                Log::error($exception->getMessage(), [
                    'job'   => $jobClass,
                    'order' => $event->order,
                ]);
            } catch (TypeError $error) {
                Log::error($error->getMessage(), [
                    'job'        => $jobClass,
                    'order'      => $event->order,
                    'parameters' => $action->parameters,
                ]);
            }
        }
    }
}
