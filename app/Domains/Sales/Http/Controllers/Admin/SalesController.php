<?php
namespace App\Domains\Sales\Http\Controllers\Admin;

use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\View\View;
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
        $sale->delete();

        flash('Usunięto');

        return redirect(route('admin.sales.index'));
    }
}
