<?php
namespace App\Http\Livewire\Admin\Action;

use App\Domains\Actions\ActionsHelper;
use App\Domains\Actions\Models\Action;
use App\Domains\Integrations\Access\AccessProvider;
use Illuminate\Support\Arr;
use Livewire\Component;

class Access extends Component
{
    public Action $action;

    public array $providers = [];
    public ?string $selected;

    public array $courses = [];
    public int $courseId;

    public function __construct($id = null)
    {
        parent::__construct($id);
        $this->providers = ActionsHelper::getProviders(Action::ACTION_ACCESS);
    }

    public function mount()
    {
        $this->selected = Arr::get($this->action->parameters, 'provider', '');
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
