<?php
namespace App\Domains\Payu\Controllers;

use App\Domains\Payments\Repositories\OrdersRepository;
use App\Domains\Payu\Requests\IpnRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PayuIpnController extends Controller
{
    public function __invoke(IpnRequest $request, OrdersRepository $repository)
    {
        Log::info(__CLASS__,
            [
                'json'    => $request->json()->all(),
                'headers' => $request->headers->all(),
            ]);
//        Log::info(__CLASS__, $request->header());

        $extOrderId = $request->externalId();
        $order = $repository->findByHash($request->hash());

        return response()->json('ok', 200);
    }
}
