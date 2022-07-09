<?php

use App\Domains\Payu\PayuHelper;

return [
    'mateusz' => [
        'name'      => 'Mateusz',
        'enabled'   => env('PAYU_POS_PLATNOSCI_ENABLED', true),
        'env'       => PayuHelper::ENV_TEST,
        'pos_id'    => env('PAYU_POS_ID'),
        'client_id' => env('PAYU_CLIENT_ID'),
        'secret'    => env('PAYU_SECRET'),
        'md5'       => env('PAYU_MD5'),
    ],
    'darek'   => [
        'name'      => 'Darek',
        'enabled'   => env('PAYU_POS_PLATNOSCI_ENABLED', true),
        'env'       => PayuHelper::ENV_TEST,
        'pos_id'    => env('PAYU_POS_ID'),
        'client_id' => env('PAYU_CLIENT_ID'),
        'secret'    => env('PAYU_SECRET'),
        'md5'       => env('PAYU_MD5'),
    ],
];
