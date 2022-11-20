<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Payments\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Arr;

abstract class ActionJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected array $parameters;

    protected Order $order;

    public function __construct(Order $order, array $parameters = [])
    {
        $this->parameters = $parameters;
        $this->order = $order;
    }

    abstract public function handle(): void;

    public function provider(): string
    {
        return Arr::get($this->parameters, 'provider');
    }

    protected function incrementActionsCount()
    {
        $this->order->update([
            'delivered_count' => $this->order->delivered_count + 1,
        ]);
    }
}
