<?php
namespace App\Domains\Payments\Mail;

use App\Domains\Payments\Models\PaymentRequest;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentRequestMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var PaymentRequest
     */
    public $paymentRequest;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(PaymentRequest $paymentRequest)
    {
        $this->paymentRequest = $paymentRequest;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this
            ->from(config('mail.from'))
            ->replyTo(config('mail.reply-to'))
            ->subject(config('app.name') . ' | Płatność ' . $this->paymentRequest->id)
            ->markdown('mails.payment-request');
    }
}
