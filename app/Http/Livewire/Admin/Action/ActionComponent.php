<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\ActionsHelper;
use App\Domains\Actions\Models\Action;
use Illuminate\Support\Arr;
use Livewire\Component;

class ActionComponent extends Component
{
    public Action $action;

    public array $providers = [];
    public ?string $selected;

    public function __construct($id = null)
    {
        parent::__construct($id);
    }

    public function mount() : void
    {
        $this->providers = ActionsHelper::getProviders($this->action->getType());
        $this->selected = Arr::get($this->action->parameters, 'provider', '');
    }
}
