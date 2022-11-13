<?php
namespace App\Domains\P24\Controllers;

use App\Domains\P24\P24Driver;
use App\Domains\Payments\Models\Order;
use App\Domains\Payments\Repositories\OrdersRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Przelewy24\Exceptions\ApiResponseException;

class P24IpnController extends Controller
{
    public function __invoke(string $provider, Request $request, OrdersRepository $repository)
    {
        $p24Driver = new P24Driver($provider);
        $p24Client = $p24Driver->getClient();

        $webhook = $p24Client->handleWebhook();
        $externalId = $webhook->orderId();
        $sessionId = $webhook->sessionId();

        /** @var Order $order */
        $order = Order::findOrFail($sessionId);

        try {
            $p24Client->verify([
                'session_id' => $sessionId,
                'order_id'   => $webhook->orderId(),   // przelewy24 order id
                'amount'     => $order->getPriceInCents(),
            ]);

            $repository->confirm($order, $externalId);
        } catch (ApiResponseException $exception) {
            Log::error('Verification failed', [
                'message' => $exception->getMessage(),
            ]);
            $repository->cancel($order);
        }

        Log::info(__CLASS__,
            [
                'payload'       => $request->all(),
                'webhook'       => $webhook,
                'provider'      => $provider,
                'p24order'      => $externalId,
                'order_session' => $sessionId,
                'statement'     => $webhook->statement(),
            ]);

        return response()->json(['ok'], 200);
    }
}
