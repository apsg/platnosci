<?php
namespace App\Http\Livewire\Tables;

use App\Domains\Payments\Models\PaymentRequest;
use App\Domains\Payments\PaymentRequestMailService;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
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

            DateColumn::name('last_email_sent_at')
                ->label('Mail wysłano')
                ->format('Y-m-d H:i'),

            Column::callback(['id', 'confirmed_at'], function ($id, $confirmed_at) {
                return view('tables.payments.options', compact('id', 'confirmed_at'));
            })
                ->label('Opcje')
                ->unsortable(),
        ];
    }

    public function sendEmail(int $id)
    {
        app(PaymentRequestMailService::class)
            ->send(PaymentRequest::findOrFail($id));
    }

    public function confirm(int $id)
    {
        PaymentRequest::find($id)->confirm();
    }
}
