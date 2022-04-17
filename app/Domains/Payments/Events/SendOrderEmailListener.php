<?php
namespace App\Domains\Payments\Events;

use App\Domains\Payments\Mails\OrderConfirmationMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendOrderEmailListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function __construct()
    {
        //
    }

    public function handle(OrderConfirmedEvent $event)
    {
        Mail::to($event->order->email)
            ->send(new OrderConfirmationMail($event->order));
    }
}
