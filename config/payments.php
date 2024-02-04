<?php

use App\Domains\Payments\PaymentsManager;
use App\Domains\Payu\PayuHelper;

return [
    'payu'    => [
        'driver'    => PaymentsManager::PAYU,
        'name'      => 'Payu testowy',
        'enabled'   => env('PAYU_POS_PLATNOSCI_ENABLED', true),
        'env'       => PayuHelper::ENV_TEST,
        'pos_id'    => env('PAYU_POS_ID'),
        'client_id' => env('PAYU_CLIENT_ID'),
        'secret'    => env('PAYU_SECRET'),
        'md5'       => env('PAYU_MD5'),
    ],
    'payu_ei'    => [
        'driver'    => PaymentsManager::PAYU,
        'name'      => 'Payu Edukacja Informatyczna',
        'enabled'   => env('PAYU_POS_PLATNOSCI_ENABLED', true),
        'env'       => PayuHelper::ENV_PROD,
        'pos_id'    => env('PAYU_POS_ID_EI'),
        'client_id' => env('PAYU_CLIENT_ID_EI'),
        'secret'    => env('PAYU_SECRET_EI'),
        'md5'       => env('PAYU_MD5_EI'),
    ],
    'payu_platnosci_inauka'    => [
        'driver'    => PaymentsManager::PAYU,
        'name'      => 'Payu Płatności iNauka',
        'enabled'   => env('PAYU_POS_PLATNOSCI_ENABLED', true),
        'env'       => PayuHelper::ENV_PROD,
        'pos_id'    => env('PAYU_POS_ID_PIN'),
        'client_id' => env('PAYU_CLIENT_ID_PIN'),
        'secret'    => env('PAYU_SECRET_PIN'),
        'md5'       => env('PAYU_MD5_PIN'),
    ],
    'p24'     => [
        'driver' => PaymentsManager::P24,
        'name'   => 'P24 BI',
        'posid'  => env('P24_POSID'),
        'token'  => env('P24_TOKEN'),
        'live'   => env('P24_LIVE', true),
    ],
    'p24_pot' => [
        'driver' => PaymentsManager::P24,
        'name'   => 'P24 OT',
        'posid'  => env('P24_OT_POSID'),
        'token'  => env('P24_OT_TOKEN'),
        'live'   => env('P24_OT_LIVE', true),
    ],
    'p24_imd' => [
        'driver' => PaymentsManager::P24,
        'name'   => 'P24 IMD',
        'posid'  => env('P24_IMD_POSID'),
        'token'  => env('P24_IMD_TOKEN'),
        'live'   => env('P24_IMD_LIVE', true),
    ],
    'p24_ie'     => [
        'driver' => PaymentsManager::P24,
        'name'   => 'P24 Edukacja Informatyczna',
        'posid'  => env('P24_POSID_IE'),
        'token'  => env('P24_TOKEN_IE'),
        'live'   => env('P24_LIVE_IE', true),
    ],
];
