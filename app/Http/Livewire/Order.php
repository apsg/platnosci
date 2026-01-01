<?php
namespace App\Http\Livewire;

use App\Domains\Payments\PaymentsManager;
use App\Domains\Payments\Repositories\OrdersRepository;
use App\Domains\Sales\Models\Sale;
use App\Rules\AcceptedBoolRule;
use App\Rules\PhoneRule;
use Livewire\Component;

class Order extends Component
{
    public Sale $sale;

    public string $email = '';

    public string $phone = '';

    public bool $accept = false;

    public function rules(): array
    {
        return [
            'email'  => 'required|email',
            'phone'  => ['required', new PhoneRule],
            'accept' => ['required', 'boolean', new AcceptedBoolRule],
        ];
    }

    protected $messages = [
        'email.required'  => 'Podaj adres email.',
        'email.email'     => 'Niepoprawny format adresu email.',
        'phone.required'  => 'Podaj numer telefonu.',
        'accept.required' => 'Wymagana jest akceptacja regulaminu',
    ];

    public function updated($propertyName): void
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.order')->with([
            'isValid' => $this->isValid(),
        ]);
    }

    public function isValid(): bool
    {
        if (!$this->accept) {
            return false;
        }

        if (empty($this->email)) {
            return false;
        }

        if (empty($this->phone)) {
            return false;
        }

        return true;
    }

    public function order()
    {
        $this->validate();

        $order = app(OrdersRepository::class)->create($this->sale, $this->email, $this->phone);

        $url = PaymentsManager::resolve($this->sale->payments_provider)
            ->forOrder($order)
            ->getUrl();

        return redirect($url);
    }
}
