<?php
namespace App\Domains\P24\Controllers;

use App\Domains\P24\P24Driver;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class P24IpnController extends Controller
{
    public function __invoke(string $provider, Request $request)
    {
        // TODO change this hardcoded provider
        $p24Driver = new P24Driver($provider);
        $p24Client = $p24Driver->getClient();

        $webhook = $p24Client->handleWebhook();
        $orderId = $webhook->orderId();

        Log::info(__CLASS__,
            [
                'payload'  => $request->json()->all(),
                'headers'  => $request->headers->all(),
                'webhook'  => $webhook,
                'provider' => $provider,
            ]);

        return response()->json(['ok'], 200);
    }
}
