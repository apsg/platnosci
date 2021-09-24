<?php
namespace App\Domains\Payments\Controllers\Admin;

use App\Domains\Payments\Models\PaymentRequest;
use App\Http\Controllers\Controller;

class PaymentRequestsController extends Controller
{
    public function show(PaymentRequest $paymentRequest)
    {
        return view('admin.payments.show')->with(compact('paymentRequest'));
    }
}
