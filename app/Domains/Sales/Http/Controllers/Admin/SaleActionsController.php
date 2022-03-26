<?php
namespace App\Domains\Sales\Http\Controllers\Admin;

use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;

class SaleActionsController extends Controller
{
    public function create(Sale $sale, string $action)
    {
        flash('Dodano akcję');

        return back();
    }
}
