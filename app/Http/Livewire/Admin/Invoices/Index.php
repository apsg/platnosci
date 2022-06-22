<?php
namespace App\Http\Livewire\Admin\Invoices;

use App\Domains\Payments\Models\InvoiceRequest;
use Illuminate\Database\Eloquent\Builder;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Index extends LivewireDatatable
{
    public $model = InvoiceRequest::class;

    public function builder(): Builder
    {
        return InvoiceRequest::with(['order.sale'])
            ->orderBy('created_at', 'desc')
            ->pending();
    }

    public function columns(): array
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->linkTo('admin/invoices'),

            Column::name('order.sale.name')
                ->label('Nazwa sprzedaży'),

            NumberColumn::name('order.price')
                ->label('Cena')
                ->round(2),

            Column::name('nip')
                ->searchable(),

            Column::name('name')
                ->searchable(),

            Column::name('address'),

            DateColumn::name('created_at'),

            Column::callback(['id'], function ($id) {
                return view('livewire.admin.invoices.tables.options', compact('id'));
            })
                ->label('Opcje')
                ->unsortable(),
        ];
    }
}
