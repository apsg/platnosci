<?php
namespace App\Domains\Payments\Controllers\Admin;

use App\Domains\Payments\Events\ResendOrderMailingEvent;
use App\Domains\Payments\Models\Order;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function index()
    {
        return view('admin.orders.index');
    }

    public function resend(Order $order)
    {
        event(new ResendOrderMailingEvent($order));

        return back();
    }
}
