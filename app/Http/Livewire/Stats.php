<?php
namespace App\Http\Livewire;

use App\Domains\Sales\OrdersStats;
use Livewire\Component;

class Stats extends Component
{
    public array $stats;
    public $days;

    public function mount()
    {
        $this->stats = OrdersStats::lastNDays($this->days)->generate();
    }

    public function render()
    {
        return view('livewire.stats');
    }
}
