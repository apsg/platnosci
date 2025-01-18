<?php
namespace App\Http\Livewire\Admin\Invoices;

use App\Domains\Payments\Models\InvoiceRequest;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\DateColumn;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Index extends LivewireDatatable
{
    public $model = InvoiceRequest::class;

    public function builder(): Builder
    {
        return InvoiceRequest::forUser(Auth::user())
            ->with(['order.sale'])
            ->orderBy('invoice_requests.created_at', 'desc')
            ->pending();
    }

    public function columns(): array
    {
        return [
            NumberColumn::name('id')
                ->label('ID'),

            Column::name('order.sale.name')
                ->label('Nazwa sprzedaży'),

            NumberColumn::name('order.price')
                ->label('Cena')
                ->round(2),

            Column::name('order.email')
                ->searchable(),

            Column::name('nip')
                ->searchable()
                ->editable(),

            Column::name('name')
                ->searchable()
                ->editable(),

            Column::name('address')
                ->editable(),

            Column::name('postcode')
                ->editable(),

            Column::name('city')
                ->editable(),

            DateColumn::name('date')
                ->format('Y-m-d')
                ->label('Data sprzedaży')
                ->editable(),

            Column::callback(['id', 'external_id', 'provider'], function (int $id, $externalId, ?string $provider) {
                return view(
                    'livewire.admin.invoices.tables.accept',
                    compact('id', 'externalId', 'provider')
                );
            })
                ->label('Zatwierdzanie'),

            Column::callback(['id'], function ($id) {
                return view('livewire.admin.invoices.tables.options', compact('id'));
            })
                ->label('Opcje')
                ->unsortable(),
        ];
    }

    public function saveProvider(int $id, ?string $provider)
    {
        $invoice = InvoiceRequest::findOrFail($id);

        if (Auth::user()->cannot('update', $invoice)) {
            throw new AuthorizationException('Nie możesz tego zrobić');
        }

        $invoice->update([
            'provider' => $provider,
        ]);
    }
}
