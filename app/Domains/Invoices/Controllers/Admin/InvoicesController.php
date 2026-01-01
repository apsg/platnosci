<?php
namespace App\Domains\Invoices\Controllers\Admin;

use App\Domains\Invoices\Repositories\InvoicesRepository;
use App\Domains\Payments\Models\InvoiceRequest;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cache;

class InvoicesController extends Controller
{
    public function index(): View
    {
        return view('admin.invoices.index');
    }

    public function destroy(InvoiceRequest $invoice)
    {
        $this->authorize('delete', $invoice);

        if ($invoice->accepted_at === null) {
            $invoice->delete();
        }

        return back();
    }

    public function accept(InvoiceRequest $invoice, InvoicesRepository $repository): RedirectResponse
    {
        $this->authorize('update', $invoice);

        $cacheKey = 'invoice-debounce-' . $invoice->id;

        if (Cache::get($cacheKey) > 0) {
            return back();
        }

        Cache::remember($cacheKey, Carbon::now()->addSeconds(30), function () {
            return 1;
        });

        $repository->accept($invoice);

        return back();
    }

    public function show(InvoiceRequest $invoice)
    {
        $this->authorize('view', $invoice);

        return view('admin.invoices.show')->with(compact('invoice'));
    }
}
