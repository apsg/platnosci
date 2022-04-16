<?php
namespace App\Http\Livewire\Order;

use App\Domains\Payments\Models\Order;
use Livewire\Component;

class Status extends Component
{
    public Order $order;

    public function render()
    {
        return view('livewire.order.status');
    }
}
