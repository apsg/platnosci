<?php
namespace App\Http\Livewire;

use App\Domains\Sales\Models\Sale;
use App\Rules\NipRule;
use Livewire\Component;

class Order extends Component
{
    public Sale $sale;
    public string $email = '';
    public string $name = '';
    public bool $invoice = false;
    public string $nip = '';
    public string $address = '';
    public bool $rules = false;

    public function rules() : array
    {
        return [

            'name'    => 'required|string',
            'email'   => 'required|email',
            'nip'     => ['string', new NipRule()],
            'address' => 'string',
            'rules'   => 'required',
        ];
    }

    public function updated($propertyName) : void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.order')->with([
            'isValid' => $this->isValid(),
        ]);
    }

    public function isValid() : bool
    {
        if (!$this->rules) {
            return false;
        }

        if (empty($this->email)) {
            return false;
        }

        return true;
    }
}
