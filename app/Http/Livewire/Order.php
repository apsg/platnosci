<?php
namespace App\Http\Livewire;

use App\Domains\Sales\Models\Sale;
use Livewire\Component;

class Order extends Component
{
    public Sale $sale;
    public string $email = '';
    public string $name = '';
    public bool $invoice = false;
    public string $nip = '';

    protected array $rules = [
        'name'  => 'required|string',
        'email' => 'required|email',
        'nip'   => 'string',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.order');
    }
}
