<?php
namespace App\Http\Livewire;

use App\Domains\Payments\Models\PaymentRequest;
use Livewire\Component;

class Payment extends Component
{
    /** @var PaymentRequest */
    public $payment;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var bool */
    public $isConfirmed = false;

    public function mount(PaymentRequest $payment)
    {
        $this->name = $payment->name;
        $this->email = $payment->email;
    }

    public function render()
    {
        return view('livewire.payment');
    }
}
