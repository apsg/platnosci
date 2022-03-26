<?php
namespace App\Domains\Actions\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

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

    abstract public function handle() : void;
}
