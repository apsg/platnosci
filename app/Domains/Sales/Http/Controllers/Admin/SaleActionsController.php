<?php
namespace App\Domains\Sales\Http\Controllers\Admin;

use App\Domains\Actions\ActionsRepository;
use App\Domains\Actions\Models\Action;
use App\Domains\Sales\Models\Sale;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;

class SaleActionsController extends Controller
{
    public function create(Sale $sale, string $action, ActionsRepository $repository)
    {
        $actionModel = $repository->create($sale, $action);

        flash('Dodano akcję');

        return redirect(URL::previous() . '#action-' . $actionModel->id);
    }

    public function destroy(Action $action)
    {
        $action->delete();

        flash('Usunięto');

        return back();
    }
}
