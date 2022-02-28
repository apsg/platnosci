<?php
namespace App\Http\Livewire\Admin\Sale;

use App\Domains\Sales\Models\Sale;
use Livewire\Component;

class Edit extends Component
{
    public Sale $sale;

    public function render()
    {
        return view('livewire.admin.sale.edit')->with([
            'sale' => $this->sale,
        ]);
    }

    public function rules() : array
    {
        return [
            'sale.name'        => 'required|string',
            'sale.description' => 'required|string',
            'sale.price'       => 'required|numeric|min:0.01',
            'sale.full_price'  => 'nullable|numeric|min:0.01',
            'sale.rules_url'   => 'nullable|sometimes|string',
        ];
    }

    public function update()
    {
        $this->validate();
        $this->sale->save();
    }
}