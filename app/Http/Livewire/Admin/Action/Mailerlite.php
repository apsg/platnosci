<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\Models\Action;
use Illuminate\Support\Arr;
use MailerLiteApi\Common\Collection;
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
            'groups' => $this->groups,
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

        $response = $this->getGroupsInLoop();

        $this->groups = collect($response)
            ->map(function ($item) {
                return [
                    'id'   => $item->id,
                    'name' => $item->name,
                ];
            })->toArray();
    }

    protected function getGroupsInLoop(): array
    {
        $results = [];
        $offset = 0;
        $shouldRepeat = true;

        $sdk = (new MailerLiteApi($this->getProviderToken()));

        while ($shouldRepeat === true) {
            $items = $sdk
                ->groups()
                ->limit(100)
                ->offset($offset)
                ->get();

            if ($this->isError($items)) {
                throw new \Exception('Mailerlite error: ' . $items[0]->error->message);
            }

            array_push($results, ...$items->toArray());
            $offset += 100;
            $shouldRepeat = $items->count() === 100;
        }

        return $results;
    }

    private function getProviderToken(): string
    {
        return config('integrations.'
            . Action::ACTION_MAILERLITE
            . '.providers.'
            . $this->selected
            . '.token');
    }

    protected function isError(array|Collection $response): bool
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
