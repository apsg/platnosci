<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\Models\Action;
use Apsg\Baselinker\Baselinker\Products;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;

class Baselinker extends ActionComponent
{
    public array $products = [];

    public string $productId;

    protected array $rules = [
        'selected'  => 'required|string',
        'productId' => 'required|string',
    ];

    public function mount(): void
    {
        parent::mount();

        $this->loadProducts();
        $this->productId = Arr::get($this->action->parameters, 'product_id', '');
    }

    public function render()
    {
        return view('livewire.admin.action.baselinker');
    }

    public function loadProducts(): void
    {
        if (empty($this->selected)) {
            $this->productId = '';
            $this->products = [];

            return;
        }

        $this->products = collect((new Products(
            new Client(),
            config($this->getProviderKey()))
        )
            ->getProductsList())
            ->map(function ($item) {
                return [
                    'id'   => $item->product_id,
                    'name' => $item->name,
                ];
            })->toArray();
    }

    public function save()
    {
        $this->validate();

        $this->action->update([
            'parameters' => [
                'provider'   => $this->selected,
                'product_id' => $this->productId,
            ],
        ]);

        session()->flash('message', 'Zapisano');
    }

    private function getProviderKey(): string
    {
        return 'integrations.'
            . Action::ACTION_BASELINKER
            . '.providers.'
            . $this->selected
            . '.key';
    }
}
