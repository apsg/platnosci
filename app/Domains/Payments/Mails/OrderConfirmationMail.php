<?php

namespace App\Domains\Payments\Mails;

use App\Domains\Payments\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrderConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public Order $order;

    public function __construct(Order $order)
    {
        //
        $this->order = $order;
    }

    public function build()
    {
        return $this->markdown('mail.order-confirmation-mail')
            ->from([
                'address' => config('mail.from.address'),
                'name'    => config('app.name'),
            ])
            ->subject("Zamówienie #{$this->order->id} potwierdzone");
    }
}
