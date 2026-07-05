<?php
namespace App\Http\Livewire;

use Livewire\Component;

class ShowPrice extends Component
{
    public $price;

    public $initialPrice;

    protected $listeners = ['price-changed' => 'priceChanged'];

    public function render()
    {
        return view('livewire.show-price');
    }

    public function mount(): void
    {
        $this->price = $this->initialPrice;
    }

    public function priceChanged($price): void
    {
        $this->price = $price;
    }
}
