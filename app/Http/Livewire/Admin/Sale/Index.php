<?php
namespace App\Http\Livewire\Admin\Sale;

use App\Domains\Sales\Models\Sale;
use Illuminate\Support\Facades\Auth;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\NumberColumn;

class Index extends LivewireDatatable
{
    public $model = Sale::class;

    public function builder()
    {
        return Auth::user()->sales();
    }

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->linkTo('admin/sales'),

            Column::name('name')
                ->label('Nazwa wewnętrzna')
                ->searchable(),

            Column::name('description')
                ->label('Opis')
                ->searchable(),

            NumberColumn::name('price')
                ->label('Cena')
                ->round(2),

            NumberColumn::name('full_price')
                ->label('Cena przed obniżką'),

            Column::callback(['id', 'is_active'], function ($id, $isActive) {
                return view('livewire.admin.sale.tables._active', compact('id', 'isActive'));
            })
                ->label('Aktywna')
                ->unsortable(),

            Column::callback(['id'], function ($id) {
                return view('livewire.admin.sale.tables._options', compact('id'));
            })
                ->label('Opcje')
                ->unsortable(),
        ];
    }
}
