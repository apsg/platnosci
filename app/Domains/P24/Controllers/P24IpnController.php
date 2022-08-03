<?php
namespace App\Domains\P24\Controllers;

use App\Domains\P24\P24Driver;
use App\Domains\Payments\Models\Order;
use App\Domains\Payments\Repositories\OrdersRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class P24IpnController extends Controller
{
    public function __invoke(string $provider, Request $request, OrdersRepository $repository)
    {
        $p24Driver = new P24Driver($provider);
        $p24Client = $p24Driver->getClient();

        $webhook = $p24Client->handleWebhook();
        $externalId = $webhook->orderId();

        $order = Order::findOrFail($webhook->sessionId());
        $repository->confirm($order, $externalId);

        Log::info(__CLASS__,
            [
                'payload'       => $request->all(),
                'webhook'       => $webhook,
                'provider'      => $provider,
                'p24order'      => $externalId,
                'order_session' => $webhook->sessionId(),
                'statement'     => $webhook->statement(),
            ]);

        return response()->json(['ok'], 200);
    }
}
