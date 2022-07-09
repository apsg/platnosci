<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Integrations\Access\AccessProvider;
use Illuminate\Support\Arr;

class Access extends ActionComponent
{
    public array $courses = [];

    public int $courseId;

    public function mount(): void
    {
        parent::mount();

        $this->loadCourses();
        $this->courseId = Arr::get($this->action->parameters, 'course_id', 0);
    }

    public function render()
    {
        return view('livewire.admin.action.access');
    }

    protected array $rules = [
        'selected' => 'required|string',
        'courseId' => 'required|integer',
    ];

    public function loadCourses()
    {
        if (empty($this->selected)) {
            $this->courses = [];
            $this->courseId = 0;

            return;
        }

        $this->courses = AccessProvider::make(strtolower($this->selected))->courses();
        $this->courseId = 0;
    }

    public function save()
    {
        $this->validate();

        $this->action->update([
            'parameters' => [
                'provider'  => $this->selected,
                'course_id' => $this->courseId,
            ],
        ]);

        session()->flash('message', 'Zapisano');
    }
}
