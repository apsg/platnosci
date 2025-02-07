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
        if ($this->days === 0){
            $this->stats = OrdersStats::today()->generate();
        }

        $this->stats = OrdersStats::lastNDays($this->days)->generate();
    }

    public function render()
    {
        return view('livewire.stats');
    }
}
