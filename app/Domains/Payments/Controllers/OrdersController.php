<?php
namespace App\Domains\Payments\Controllers;

use App\Domains\Payments\Models\Order;
use App\Http\Controllers\Controller;

class OrdersController extends Controller
{
    public function continue(Order $order)
    {
        return view('orders.continue')->with(compact('order'));
    }
}
