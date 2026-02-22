<?php
namespace App\Http\Livewire\Admin\Invoices;

use App\Domains\Invoices\Repositories\InvoicesRepository;
use App\Domains\Payments\Models\InvoiceRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Show extends Component
{
    public InvoiceRequest $invoice;

    public $nip;

    public $name;

    public $address;

    public $postcode;

    public $city;

    public $date;

    public $provider;

    protected $rules = [
        'nip'      => 'required|string|max:255',
        'name'     => 'required|string|max:255',
        'address'  => 'required|string|max:255',
        'postcode' => 'required|string|max:255',
        'city'     => 'required|string|max:255',
        'date'     => 'required|date',
        'provider' => 'required|string',
    ];

    public function mount(InvoiceRequest $invoice)
    {
        if (Auth::user()->cannot('update', $invoice)) {
            throw new AuthorizationException('Nie możesz tego zrobić');
        }

        $this->invoice = $invoice;
        $this->nip = $invoice->nip;
        $this->name = $invoice->name;
        $this->address = $invoice->address;
        $this->postcode = $invoice->postcode;
        $this->city = $invoice->city;
        $this->date = $invoice->date?->format('Y-m-d');
        $this->provider = $invoice->provider;
    }

    public function updatedProvider($value)
    {
        $this->invoice->update([
            'provider' => $value,
        ]);
    }

    public function canAccept(): bool
    {
        return !empty($this->nip) &&
               !empty($this->name) &&
               !empty($this->address) &&
               !empty($this->postcode) &&
               !empty($this->city) &&
               !empty($this->date) &&
               !empty($this->provider);
    }

    public function save()
    {
        if (Auth::user()->cannot('update', $this->invoice)) {
            throw new AuthorizationException('Nie możesz tego zrobić');
        }

        if ($this->invoice->accepted_at !== null) {
            session()->flash('error', 'Nie można edytować zaakceptowanej faktury.');

            return;
        }

        $this->validate();

        $this->invoice->update([
            'nip'      => $this->nip,
            'name'     => $this->name,
            'address'  => $this->address,
            'postcode' => $this->postcode,
            'city'     => $this->city,
            'date'     => $this->date,
        ]);

        session()->flash('message', 'Faktura zaktualizowana pomyślnie.');
    }

    public function accept(InvoicesRepository $repository)
    {
        if (Auth::user()->cannot('update', $this->invoice)) {
            throw new AuthorizationException('Nie możesz tego zrobić');
        }

        if ($this->invoice->accepted_at !== null) {
            session()->flash('error', 'Faktura została już zaakceptowana.');

            return;
        }

        $repository->accept($this->invoice);

        $this->invoice->refresh();

        session()->flash('message', 'Faktura została zaakceptowana pomyślnie.');
    }

    public function render()
    {
        return view('livewire.admin.invoices.show');
    }
}
