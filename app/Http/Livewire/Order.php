<?php
namespace App\Http\Livewire;

use App\Domains\Payments\PaymentsManager;
use App\Domains\Payments\Repositories\OrdersRepository;
use App\Domains\Sales\Models\Sale;
use App\Rules\AcceptedBoolRule;
use App\Rules\PeselRule;
use App\Rules\PhoneRule;
use App\Rules\RequirementsRule;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Order extends Component
{
    public Sale $sale;

    public string $email = '';

    public string $phone = '';

    public bool $accept = false;

    public bool $isPesel = false;

    public ?string $pesel = null;

    public ?string $firstname = null;

    public ?string $lastname = null;

    public function rules(): array
    {
        return [
            'email'     => ['required', 'email', new RequirementsRule($this->sale)],
            'phone'     => ['required', new PhoneRule],
            'accept'    => ['required', 'boolean', new AcceptedBoolRule],
            'isPesel'   => ['required', 'boolean'],
            'pesel'     => Rule::when($this->isPesel,
                ['required', 'string', 'required_if:isPesel,true', new PeselRule]
            ),
            'firstname' => ['required_if:isPesel,true', 'string'],
            'lastname'  => ['required_if:isPesel,true', 'string'],
        ];
    }

    protected $messages = [
        'email.required'  => 'Podaj adres email.',
        'email.email'     => 'Niepoprawny format adresu email.',
        'phone.required'  => 'Podaj numer telefonu.',
        'accept.required' => 'Wymagana jest akceptacja regulaminu',
        'pesel'           => 'Podaj poprawny numer PESEL',
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

        $order = app(OrdersRepository::class)
            ->create(
                $this->sale,
                $this->email,
                $this->phone,
                $this->isPesel ? $this->pesel : null,
                $this->isPesel ? $this->firstname : null,
                $this->isPesel ? $this->lastname : null
            );

        $url = PaymentsManager::resolve($this->sale->payments_provider)
            ->forOrder($order)
            ->getUrl();

        return redirect($url);
    }

    public function getPriceFinalProperty(): string
    {
        $price = $this->sale->price;
        if (!$this->isPesel) {
            $price = 1.23 * $price;
        }

        return number_format($price, 2);
    }

    public function getFullPriceFinalProperty(): string
    {
        $price = $this->sale->full_price;
        if (!$this->isPesel) {
            $price = 1.23 * $price;
        }

        return number_format($price, 2);
    }
}
