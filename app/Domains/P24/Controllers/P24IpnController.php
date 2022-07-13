<?php
namespace App\Domains\P24\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;

class P24IpnController extends Controller
{
    public function __invoke()
    {

        Log::info(__CLASS__,
            [
                'payload'      => $request->json()->all(),
                'headers'      => $request->headers->all(),
                'verification' => $verifySignature,
            ]);

        return response()->json(['ok'], 200);
    }
}
