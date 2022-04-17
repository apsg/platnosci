<?php

namespace App\Http\Livewire\Order;

use App\Domains\Payments\Models\Order;
use App\Rules\NipRule;
use Livewire\Component;

class Invoice extends Component
{
    public Order $order;
    public string $nip = '';
    public string $name = '';
    public string $address = '';
    public bool $isSent = false;

    public function rules()
    {
        return [
            'nip'     => ['required', new NipRule()],
            'name'    => ['required', 'string', 'min:3'],
            'address' => ['required', 'string', 'min:3'],
        ];
    }

    protected $messages = [
        'nip.required'     => 'Numer NIP jest wymagany',
        'name.required'    => 'Podaj nazwę',
        'name.min'         => 'Nazwa zbyt krótka',
        'address.required' => 'Adres jest wymagany',
        'address.min'      => 'Adres jest zbyt krótki',
    ];

    public function render()
    {
        return view('livewire.order.invoice');
    }

    public function updated($propertyName) : void
    {
        $this->validateOnly($propertyName);
    }

    public function send()
    {
        $this->validate();

        $this->order->invoice_request()->create([
            'name'    => $this->name,
            'nip'     => $this->nip,
            'address' => $this->address,
        ]);

        $this->isSent = true;
    }
}
