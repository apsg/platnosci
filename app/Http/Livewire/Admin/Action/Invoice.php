<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\ActionsHelper;
use App\Domains\Actions\Models\Action;
use Illuminate\Support\Arr;
use Livewire\Component;

class Invoice extends Component
{
    public Action $action;
    public array $providers;
    public string $selected;

    protected array $rules = [
        'selected' => 'required|string',
    ];

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->providers = ActionsHelper::getProviders(Action::ACTION_INVOICE);
    }

    public function mount()
    {
        $this->selected = Arr::get($this->action->parameters, 'provider', '');
    }

    public function render()
    {
        return view('livewire.admin.action.invoice');
    }

    public function save()
    {
        $this->validate();

        $this->action->update([
            'parameters' => [
                'provider'  => $this->selected,
            ],
        ]);

        session()->flash('message', 'Zapisano');
    }
}
