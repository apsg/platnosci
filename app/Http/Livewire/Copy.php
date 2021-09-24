<?php
namespace App\Http\Livewire;

use Illuminate\Support\Str;
use Livewire\Component;

class Copy extends Component
{
    /** @var string */
    public $text;

    /** @var string */
    public $inputId;

    public function mount()
    {
        $this->inputId = 'copy_' . Str::random(6);
    }

    public function render()
    {
        return view('livewire.copy');
    }
}
