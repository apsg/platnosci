<?php
namespace App\Http\Livewire\Admin\Sale;

use App\Domains\Invoices\InvoicesManager;
use App\Domains\Payments\PaymentsManager;
use App\Domains\Sales\Models\Sale;
use App\Rules\InvoiceProviderRule;
use App\Rules\PaymentsProviderRule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Edit extends Component
{
    public Sale $sale;

    public array $paymentSystems;

    public array $invoiceSystems;

    public function mount()
    {
        $this->paymentSystems = PaymentsManager::listAvailableSystems();
        $this->invoiceSystems = InvoicesManager::listAvailableSystems();
    }

    public function render()
    {
        return view('livewire.admin.sale.edit')->with([
            'sale' => $this->sale,
        ]);
    }

    public function rules(): array
    {
        return [
            'sale.name'                     => 'required|string',
            'sale.description'              => 'required|string',
            'sale.price'                    => 'required|numeric|min:0.01',
            'sale.full_price'               => 'nullable|numeric|min:0.01',
            'sale.rules_url'                => 'nullable|sometimes|string',
            'sale.redirect_url'             => 'nullable|sometimes|string|url',
            'sale.counter'                  => 'nullable|sometimes|integer|min:0',
            'sale.payments_provider'        => ['nullable', new PaymentsProviderRule()],
            'sale.default_invoice_provider' => ['nullable', new InvoiceProviderRule()],

        ];
    }

    public function update()
    {
        if (Auth::user()->cannot('update', $this->sale)) {
            throw new AuthorizationException('Nie możesz tego zrobić');
        }

        $this->validate();
        $this->sale->save();

        session()->flash('message', 'Zapisano!');
    }
}
