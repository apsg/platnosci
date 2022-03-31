<?php
namespace App\Domains\Sales\Http\Controllers\Front;

use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;

class SalesController extends Controller
{
    public function show(Sale $sale)
    {
        return view('sales.show')->with(compact('sale'));
    }
}
