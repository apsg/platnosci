<?php
namespace App\Domains\Payments\Controllers\Admin;

use App\Domains\Payments\Models\InvoiceRequest;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class InvoicesController extends Controller
{
    public function index(): View
    {
        return view('admin.invoices.index');
    }

    public function destroy(InvoiceRequest $invoice)
    {
        if ($invoice->accepted_at === null) {
            $invoice->delete();
        }

        return back();
    }

    public function accept(InvoiceRequest $invoice)
    {

        return back();
    }
}
