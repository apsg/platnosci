<?php
namespace App\Http\Livewire\Admin;

use App\Domains\Payments\Models\PaymentRequest;
use Livewire\Component;

class EditPayment extends Component
{
    /** @var PaymentRequest */
    public $payment;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var float */
    public $amount;

    /** @var string */
    public $description;

    /** @var string */
    public $rulesUrl;

    /** @var bool */
    public $isMailed = false;

    protected $rules = [
        'name'        => 'required|string',
        'email'       => 'required|email',
        'amount'      => 'required|numeric|min:0.01',
        'description' => 'required|string',
    ];

    public function mount(PaymentRequest $payment)
    {
        $this->name = $payment->name;
        $this->amount = $payment->amount;
        $this->email = $payment->email;
        $this->rulesUrl = $payment->rules_url;
        $this->description = $payment->description;
    }

    public function render()
    {
        return view('livewire.admin.edit-payment');
    }

    public function update()
    {
        $this->validate();

    }

    public function mail()
    {
        $this->isMailed = true;
    }
}
