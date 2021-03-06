<?php

use App\Domains\Payments\PaymentsManager;
use App\Domains\Payu\PayuHelper;

return [
    'payu' => [
        'driver'    => PaymentsManager::PAYU,
        'name'      => 'Payu testowy',
        'enabled'   => env('PAYU_POS_PLATNOSCI_ENABLED', true),
        'env'       => PayuHelper::ENV_TEST,
        'pos_id'    => env('PAYU_POS_ID'),
        'client_id' => env('PAYU_CLIENT_ID'),
        'secret'    => env('PAYU_SECRET'),
        'md5'       => env('PAYU_MD5'),
    ],
    'p24'  => [
        'driver' => PaymentsManager::P24,
        'name'   => 'P24 Darek',
        'posid'  => env('P24_POSID'),
        'token'  => env('P24_TOKEN'),
        'live'   => env('P24_LIVE', true),
    ],
];
