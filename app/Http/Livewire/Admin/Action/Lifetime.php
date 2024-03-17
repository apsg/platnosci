<?php
namespace App\Http\Livewire\Admin\Action;

class Lifetime extends ActionComponent
{
    public function mount(): void
    {
        parent::mount();
    }

    public function render()
    {
        return view('livewire.admin.action.lifetime');
    }

    protected array $rules = [
        'selected' => 'required|string',
    ];

    public function save()
    {
        $this->validate();

        $this->action->update([
            'parameters' => [
                'provider' => $this->selected,
            ],
        ]);

        session()->flash('message', 'Zapisano');
    }
}
