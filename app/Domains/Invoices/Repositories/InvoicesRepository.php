<?php
namespace App\Domains\Invoices\Repositories;

use App\Domains\Invoices\Invoice;
use App\Domains\Payments\Models\InvoiceRequest;
use App\Domains\Payments\Models\Order;

class InvoicesRepository
{
    public function accept(InvoiceRequest $invoiceRequest): int|string
    {
        $invoice = new Invoice($invoiceRequest);
        $invoiceId = $invoice->generate();

        if (!empty($invoiceId)) {
            $invoiceRequest->update([
                'accepted_at' => now(),
                'external_id' => $invoiceId,
            ]);

            $invoice->sendByEmail();
        }

        return $invoiceId;
    }

    public function createManualFor(Order $order): InvoiceRequest
    {
        $invoiceRequest = $order->invoice_request()->create([
            'name'    => 'uzupełnij',
            'address' => 'uzupełnij',
            'nip'     => '00000000',
        ]);

        return $invoiceRequest;
    }
}
