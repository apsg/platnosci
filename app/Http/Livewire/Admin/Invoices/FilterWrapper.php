<?php
namespace App\Http\Livewire\Admin\Invoices;

use Livewire\Component;

class FilterWrapper extends Component
{
    public int $showAccepted = 0;

    public function render()
    {
        return view('livewire.admin.invoices.filter-wrapper');
    }
}
