<?php
namespace App\Domains\Sales\Http\Controllers\Admin;

use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;
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
        return view('admin.sales.edit')->with(compact('sale'));
    }
}
