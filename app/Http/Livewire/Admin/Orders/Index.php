<?php
namespace App\Http\Livewire\Admin\Orders;

use App\Domains\Payments\Models\Order;
use App\Domains\Sales\Models\Sale;
use Mediconesystems\LivewireDatatables\BooleanColumn;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Index extends LivewireDatatable
{
    public $model = Order::class;

    public function builder()
    {
        return Order::orderBy('id', 'desc');
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->linkTo('admin/orders'),

            Column::name('sale.name')
                ->filterable($this->sales->pluck('name'))
                ->label('Sprzedaż'),

            Column::name('email')
                ->label('Email')
                ->searchable(),

            Column::name('phone')
                ->label('Telefon')
                ->searchable(),

            Column::callback(['confirmed_at', 'cancelled_at'], function ($confirmedAt, $cancelledAt) {
                return view('livewire.admin.orders.tables.status', compact('confirmedAt', 'cancelledAt'));
            })
                ->label('Status'),

            Column::callback(['id'], function ($id) {
                return view('livewire.admin.orders.tables.options', compact('id'));
            })
                ->label('Opcje')
                ->unsortable(),
        ];
    }

    public function getSalesProperty()
    {
        return Sale::all();
    }
}
