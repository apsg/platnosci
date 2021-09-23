<?php
namespace App\Http\Livewire\Tables;

use App\Domains\Payments\Models\PaymentRequest;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class PaymentRequests extends LivewireDatatable
{
    public $model = PaymentRequest::class;

    public function builder()
    {
        return PaymentRequest::query();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

            Column::name('slug')
                ->label('Slug'),

            Column::name('name')
                ->label('Klient')
                ->searchable(),

            Column::name('email')
                ->label('Email')
                ->searchable(),

            Column::callback(['confirmed_at'], function ($confirmed) {
                return view('tables.payments.status', compact('confirmed'));
            })
                ->label('status')
                ->filterable(null, 'filterHasLightSaber'),

            Column::callback(['id'], function ($id) {
                return view('tables.payments.options', compact('id'));
            })->label('Opcje'),
        ];
    }
}
