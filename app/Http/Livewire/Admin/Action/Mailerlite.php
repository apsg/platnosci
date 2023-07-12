<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\Models\Action;
use Illuminate\Support\Arr;
use MailerLiteApi\MailerLite as MailerLiteApi;

class Mailerlite extends ActionComponent
{
    protected array $groups = [];

    public string $groupId = '';

    protected array $rules = [
        'selected' => 'required|string',
        'groupId'  => 'required|string',
    ];

    public function mount(): void
    {
        parent::mount();

        if ($this->isSelectedValidProvider(Action::ACTION_MAILERLITE)) {
            $this->loadGroups();
            $this->groupId = Arr::get($this->action->parameters, 'group_id', '');
        }
    }

    public function render()
    {
        $this->loadGroups();

        return view('livewire.admin.action.mailerlite')->with([
            'groups' => $this->groups
        ]);
    }

    public function save(): void
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

    public function loadGroups(): void
    {
        if (!$this->isSelectedValidProvider(Action::ACTION_MAILERLITE)) {
            $this->groups = [];
            $this->groupId = '';

            return;
        }

        $response = (new MailerLiteApi($this->getProviderToken()))
            ->groups()
            ->get(['id', 'name'])
            ->toArray();

        if ($this->isError($response)) {
            throw new \Exception('Mailerlite error: ' . $response[0]->error->message);
        }

        $this->groups = collect($response)
            ->map(function ($item) {
                return [
                    'id'   => $item->id,
                    'name' => $item->name,
                ];
            })->toArray();
    }

    private function getProviderToken(): string
    {
        return config('integrations.'
            . Action::ACTION_MAILERLITE
            . '.providers.'
            . $this->selected
            . '.token');
    }

    protected function isError(array $response): bool
    {
        if (!isset($response[0])) {
            return false;
        }

        if (isset($response[0]->error)) {
            return true;
        }

        return false;
    }
}
