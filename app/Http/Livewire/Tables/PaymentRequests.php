<?php
namespace App\Http\Livewire\Tables;

use App\Domains\Payments\Models\PaymentRequest;
use Mediconesystems\LivewireDatatables\BooleanColumn;
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
                ->label('ID')
                ->linkTo('admin/payments'),

            Column::name('slug')
                ->label('Slug')
                ->linkTo('p'),

            Column::name('name')
                ->label('Klient')
                ->searchable(),

            Column::name('email')
                ->label('Email')
                ->searchable(),

            Column::name('description')
                ->label('Tytułem')
                ->searchable(),

            Column::name('amount')
                ->label('Kwota (PLN)'),


            BooleanColumn::name('confirmed_at')
                ->label('Opłacone?')
                ->filterable(),

            Column::callback(['id'], function ($id) {
                return view('tables.payments.options', compact('id'));
            })->label('Opcje'),
        ];
    }

    public function sendEmail($id)
    {

    }

    public function confirm($id)
    {
        PaymentRequest::find($id)->confirm();
    }
}
