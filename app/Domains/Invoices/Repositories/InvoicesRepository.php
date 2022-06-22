<?php
namespace App\Domains\Invoices\Repositories;

use App\Domains\Invoices\Invoice;
use App\Domains\Payments\Models\InvoiceRequest;

class InvoicesRepository
{
    public function accept(InvoiceRequest $invoiceRequest): int|string
    {
        $invoiceId = (new Invoice($invoiceRequest))->generate();

        if (!empty($invoiceId)) {
            $invoiceRequest->update([
                'accepted_at' => now(),
                'external_id' => $invoiceId,
            ]);
        }

        return $invoiceId;
    }
}
