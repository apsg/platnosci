<?php
namespace App\Http\Livewire\Admin\Sale;

use App\Domains\Sales\Models\Sale;
use Livewire\Component;
use function redirect;
use function view;

class Create extends Component
{
    public string $name = '';
    public string $description = '';
    public float $price = 0.0;
    public ?float $fullPrice = null;
    public ?string $rulesUrl = null;

    protected array $rules = [
        'name'        => 'required|string',
        'price'       => 'required|numeric|min:0.01',
        'fullPrice'   => 'sometimes|numeric|min:0.01',
        'description' => 'required|string',
        'rulesUrl'    => 'sometimes|string',
    ];

    public function render()
    {
        return view('livewire.admin.sale.create');
    }

    public function store()
    {
        $sale = Sale::create([
            'name'        => $this->name,
            'price'       => $this->price,
            'full_price'  => $this->fullPrice,
            'description' => $this->description,
            'rules_url'   => $this->rulesUrl,
        ]);

        return redirect(route('admin.sales.edit', $sale));
    }
}
