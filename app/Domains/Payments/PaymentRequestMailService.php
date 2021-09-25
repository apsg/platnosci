<?php
namespace App\Domains\Payments;

use App\Domains\Payments\Mail\PaymentRequestMail;
use App\Domains\Payments\Models\PaymentRequest;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class PaymentRequestMailService
{
    public function send(PaymentRequest $paymentRequest)
    {
        Mail::to($paymentRequest->email)
            ->send(new PaymentRequestMail($paymentRequest));

        $paymentRequest->update([
            'last_email_sent_at' => Carbon::now(),
        ]);
    }
}
