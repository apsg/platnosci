<?php

return [
    'providers' => [
        'tmgfv' => [
            'name'  => 'Mateusz Grabowski',
            'url'   => env('FAKTUROWNIA_URL_MATEUSZ', 'https://tmgfv.fakturownia.pl'),
            'token' => env('FAKTUROWNIA_TOKEN_MATEUSZ'),
        ],
        'imd'   => [
            'name'  => 'Dariusz Skórniewski',
            'url'   => env('FAKTUROWNIA_URL_DARIUSZ'),
            'token' => env('FAKTUROWNIA_TOKEN_DARIUSZ'),
        ],
    ],
];
