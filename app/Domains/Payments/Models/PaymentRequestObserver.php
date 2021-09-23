<?php
namespace App\Domains\Payments\Models;

use Illuminate\Support\Str;

class PaymentRequestObserver
{
    public function created(PaymentRequest $paymentRequest)
    {
        if ($paymentRequest->slug !== null) {
            return;
        }

        $paymentRequest->update([
            'slug' => Str::lower(Str::random(10)),
        ]);
    }
}
