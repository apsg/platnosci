<?php
namespace App\Http\Livewire\Admin\Sale;

use App\Domains\Invoices\InvoicesManager;
use App\Domains\Payments\PaymentsManager;
use App\Domains\Sales\Models\Sale;
use App\Models\User;
use App\Rules\InvoiceProviderRule;
use App\Rules\PaymentsProviderRule;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use function redirect;
use function view;

class Create extends Component
{
    public string $name = '';
    public string $description = '';
    public ?float $price = null;
    public ?float $fullPrice = null;
    public ?string $rulesUrl = null;
    public ?int $counter = null;
    public ?string $paymentsProvider = null;
    public ?string $defaultInvoiceProvider = null;

    public array $paymentSystems;
    public array $invoiceSystems;

    public function mount()
    {
        $this->paymentSystems = PaymentsManager::listAvailableSystems();
        $this->invoiceSystems = InvoicesManager::listAvailableSystems();
    }

    public function rules(): array
    {
        return [
            'name'                     => 'required|string',
            'price'                    => 'required|numeric|min:0.01',
            'fullPrice'                => 'sometimes|numeric|min:0.01',
            'description'              => 'required|string',
            'rulesUrl'                 => 'sometimes|string',
            'counter'                  => 'sometimes|nullable|integer|min:0',
            'payments_provider'        => ['nullable', new PaymentsProviderRule()],
            'default_invoice_provider' => ['nullable', new InvoiceProviderRule()],
        ];
    }

    public function render()
    {
        return view('livewire.admin.sale.create');
    }

    public function store()
    {
        /** @var User $user */
        $user = Auth::user();

        if ($user->cannot('create', Sale::class)) {
            throw new AuthorizationException('Nie możesz tego zrobić');
        }

        $sale = Sale::create([
            'user_id'                  => $user->id,
            'name'                     => $this->name,
            'price'                    => $this->price,
            'full_price'               => $this->fullPrice,
            'description'              => $this->description,
            'rules_url'                => $this->rulesUrl,
            'counter'                  => $this->counter,
            'payments_provider'        => $this->paymentsProvider,
            'default_invoice_provider' => $this->defaultInvoiceProvider,
        ]);

        return redirect(route('admin.sales.edit', $sale));
    }
}
