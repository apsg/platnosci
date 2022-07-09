<?php
namespace App\Http\Livewire\Admin\Sale;

use App\Domains\Sales\Models\Sale;
use App\Rules\PaymentsProviderRule;
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

    public function rules(): array
    {
        return [
            'name'              => 'required|string',
            'price'             => 'required|numeric|min:0.01',
            'fullPrice'         => 'sometimes|numeric|min:0.01',
            'description'       => 'required|string',
            'rulesUrl'          => 'sometimes|string',
            'counter'           => 'sometimes|nullable|integer|min:0',
            'payments_provider' => ['nullable', new PaymentsProviderRule()],

        ];
    }

    public function render()
    {
        return view('livewire.admin.sale.create');
    }

    public function store()
    {
        $sale = Sale::create([
            'name'              => $this->name,
            'price'             => $this->price,
            'full_price'        => $this->fullPrice,
            'description'       => $this->description,
            'rules_url'         => $this->rulesUrl,
            'counter'           => $this->counter,
            'payments_provider' => $this->paymentsProvider,
        ]);

        return redirect(route('admin.sales.edit', $sale));
    }
}
