<?php
namespace App\Domains\Sales\Http\Controllers\Admin;

use App\Domains\Actions\ActionsRepository;
use App\Domains\Actions\Models\Action;
use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;

class SaleActionsController extends Controller
{
    public function create(Sale $sale, string $action, ActionsRepository $repository)
    {
        $repository->create($sale, $action);

        flash('Dodano akcję');

        return back();
    }

    public function destroy(Action $action)
    {
        $action->delete();

        flash('Usunięto');

        return back();
    }
}
