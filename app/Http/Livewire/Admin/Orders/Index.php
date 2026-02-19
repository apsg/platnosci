<?php
namespace App\Http\Livewire\Admin\Orders;

use App\Domains\Payments\Models\Order;
use App\Domains\Sales\Models\Sale;
use App\Livewire\TimezonedDateColumn;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Index extends LivewireDatatable
{
    public $model = Order::class;

    public function builder()
    {
        return Order::forUser(Auth::user())
            ->leftJoin('sales', 'orders.sale_id', '=', 'sales.id')
            ->leftJoin('invoice_requests', 'orders.id', '=', 'invoice_requests.order_id')
            ->orderBy('id', 'desc');
    }

    public function columns(): array
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

            TimezonedDateColumn::name('orders.created_at')
                ->label('Data')
                ->format('Y-m-d H:i')
                ->sortable(),

            Column::name('sale.name')
                ->label('Sprzedaż')
                ->searchable(),

            Column::name('email')
                ->label('Email')
                ->searchable(),

            Column::name('phone')
                ->label('Telefon')
                ->searchable(),

            Column::callback(['confirmed_at', 'cancelled_at'], function ($confirmed_at, $cancelled_at) {
                return view('livewire.admin.orders.tables.status', compact('confirmed_at', 'cancelled_at'));
            })
                ->label('Status'),

            NumberColumn::name('price')
                ->label('Kwota sprzedaży (PLN)'),

            Column::callback([
                'invoice_requests.accepted_at',
                'invoice_requests.external_id',
                'invoice_requests.provider',
            ], function ($acceptedAt, $externalId, $provider) {
                return view(
                    'livewire.admin.orders.tables.invoice',
                    compact('acceptedAt', 'externalId', 'provider')
                );
            })
                ->label('Faktura'),

            Column::callback(['actions_count', 'delivered_count'], function ($actions_count, $delivered_count) {
                return view('livewire.admin.orders.tables.actions', compact('actions_count', 'delivered_count'));
            })->label('Akcje'),

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
