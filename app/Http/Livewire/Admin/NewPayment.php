<?php
namespace App\Http\Livewire\Admin;

use App\Domains\Payments\Models\PaymentRequest;
use Livewire\Component;

class NewPayment extends Component
{
    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var float */
    public $amount;

    /** @var string */
    public $description = 'Zaliczka za pobyt';

    /** @var string */
    public $rulesUrl;

    protected $rules = [
        'name'        => 'required|string',
        'email'       => 'required|email',
        'amount'      => 'required|numeric|min:0.01',
        'description' => 'required|string',
    ];

    public function mount()
    {
        $this->rulesUrl = config('app.rules_url');
    }

    public function render()
    {
        return view('livewire.admin.new-payment');
    }

    public function store()
    {
        $this->validate();

        $paymentRequest = PaymentRequest::create([
            'name'        => $this->name,
            'email'       => $this->email,
            'amount'      => $this->amount,
            'description' => $this->description,
            'rules_url'   => $this->rulesUrl,
        ]);

        return redirect(route('payments.show', $paymentRequest));
    }
}
