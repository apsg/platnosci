<?php
namespace App\Domains\Payu\Controllers;

use App\Domains\Payments\Repositories\OrdersRepository;
use App\Domains\Payu\Exceptions\SignatureMismatchException;
use App\Domains\Payu\PayuDriver;
use App\Domains\Payu\Requests\IpnRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class PayuIpnController extends Controller
{
    public function __invoke(IpnRequest $request, OrdersRepository $repository)
    {
        $payu = new PayuDriver('payu');
        $verifySignature = $payu->verifySignature($request->getContent(), $request->getSignature());

        Log::info(__CLASS__,
            [
                'payload'      => $request->json()->all(),
                'headers'      => $request->headers->all(),
                'verification' => $verifySignature,
            ]);

        if ($verifySignature !== true) {
            throw new SignatureMismatchException($request->getContent());
        };

        $extOrderId = $request->externalId();
        $order = $repository->findByHash($request->hash());

        if ($order === null) {
            return response([], 404);
        }

        if ($request->isStatusCanceled()) {
            $repository->cancel($order);
        }

        if ($request->isStatusCompleted()) {
            $repository->confirm($order, $extOrderId);
        }

        return response('ok', 200);
    }
}
