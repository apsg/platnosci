<?php
namespace App\Livewire;

use Illuminate\Support\Carbon;
use Mediconesystems\LivewireDatatables\DateColumn;

class TimezonedDateColumn extends DateColumn
{
    public function format($format = null)
    {
        $this->callback = function ($value) use ($format) {
            return $value
                ? Carbon::parse($value)
                    ->setTimezone('Europe/Warsaw')
                    ->format($format ?? config('livewire-datatables.default_datetime_format'))
                : null;
        };

        return $this;
    }
}
