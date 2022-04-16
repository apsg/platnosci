<?php
namespace App\Domains\Payu\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PayuIpnController extends Controller
{
    public function __invoke(Request $request)
    {
        Log::info(__CLASS__, $request->all());
    }
}
