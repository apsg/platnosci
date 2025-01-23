<?php
namespace App\Console\Commands;

use App\Domains\Payments\Models\InvoiceRequest;
use Illuminate\Console\Command;

class RewriteInvoiceDatesCommand extends Command
{
    protected $signature = 'invoices:rewrite-dates';

    protected $description = 'Rewrite invoice dates';

    public function handle()
    {
        $this->info('Rewriting invoice dates...');

        $invoiceRequests = InvoiceRequest::pending()
            ->with('order')
            ->get();

        foreach ($invoiceRequests as $invoiceRequest) {
            $invoiceRequest->date = $invoiceRequest->order->created_at;
            $invoiceRequest->save();
        }
    }
}
