<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\Models\Action;
use Illuminate\Support\Arr;
use MailerLiteApi\MailerLite as MailerLiteApi;

class Mailerlite extends ActionComponent
{
    public array $groups = [];
    public string $groupId = '';

    protected array $rules = [
        'selected' => 'required|string',
        'groupId'  => 'required|string',
    ];

    public function mount() : void
    {
        parent::mount();

        if ($this->isSelectedValidProvider(Action::ACTION_MAILERLITE)) {
            $this->loadGroups();
            $this->groupId = Arr::get($this->action->parameters, 'group_id', '');
        }
    }

    public function render()
    {
        return view('livewire.admin.action.mailerlite');
    }

    public function save() : void
    {
        $this->validate();

        $this->action->update([
            'parameters' => [
                'provider' => $this->selected,
                'group_id' => $this->groupId,
            ],
        ]);

        session()->flash('message', 'Zapisano!');
    }

    public function loadGroups() : void
    {
        if (!$this->isSelectedValidProvider(Action::ACTION_MAILERLITE)) {
            $this->groups = [];
            $this->groupId = '';

            return;
        }

        $this->groups = collect((new MailerLiteApi($this->getProviderToken()))
            ->groups()
            ->get(['id', 'name'])
            ->toArray())
            ->map(function ($item) {
                return [
                    'id'   => $item->id,
                    'name' => $item->name,
                ];
            })->toArray();
    }

    private function getProviderToken() : string
    {
        return config('integrations.'
            . Action::ACTION_MAILERLITE
            . '.providers.'
            . $this->selected
            . '.token');
    }
}
