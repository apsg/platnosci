<?php
namespace App\Domains\Invoices\Controllers\Admin;

use App\Domains\Invoices\Repositories\InvoicesRepository;
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

    public function accept(InvoiceRequest $invoice, InvoicesRepository $repository)
    {
        $repository->accept($invoice);

        return back();
    }
}
