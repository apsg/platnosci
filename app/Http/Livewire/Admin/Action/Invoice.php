<?php
namespace App\Http\Livewire\Admin\Action;

class Invoice extends ActionComponent
{
    protected array $rules = [
        'selected' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.admin.action.invoice');
    }

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
