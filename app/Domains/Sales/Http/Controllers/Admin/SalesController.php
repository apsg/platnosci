<?php
namespace App\Domains\Sales\Http\Controllers\Admin;

use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use function view;

class SalesController extends Controller
{
    public function index()
    {
        return view('admin.sales.index');
    }

    public function create()
    {
        return view('admin.sales.create');
    }

    public function edit(Sale $sale)
    {
        $this->authorize('view', $sale);

        return view('admin.sales.edit')->with(compact('sale'));
    }

    public function update(Sale $sale)
    {
        return back();
    }

    public function delete(Sale $sale)
    {
        $this->authorize('delete', $sale);
        try {
            $sale->delete();
        } catch (QueryException $exception) {
            // Foreign key check
            flash('Nie można usunąć sprzedaży, którą ktoś już zamówił.');

            return back();
        }

        flash('Usunięto');

        return redirect(route('admin.sales.index'));
    }
}
