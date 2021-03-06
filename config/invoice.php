<?php

return [
    'providers' => [
        'tmgfv' => [
            'name'     => 'Business Intelligence Training Dariusz Skórniewski, Mateusz Grabowski Spółka Cywilna',
            'nip'      => '9691646458',
            'address'  => 'Brzozowa 10/3',
            'postcode' => '44-177',
            'city'     => 'Paniówki',
            'url'      => env('FAKTUROWNIA_URL_MATEUSZ', 'https://tmgfv.fakturownia.pl'),
            'token'    => env('FAKTUROWNIA_TOKEN_MATEUSZ'),
        ],
        'imd'   => [
            'name'     => 'Professional Office Training Dariusz Skórniewski, Mateusz Grabowski Spółka Cywilna',
            'nip'      => '9691646441',
            'address'  => 'Brzozowa 10/3',
            'postcode' => '44-177',
            'city'     => 'Paniówki',
            'url'      => env('FAKTUROWNIA_URL_DARIUSZ'),
            'token'    => env('FAKTUROWNIA_TOKEN_DARIUSZ'),
        ],
    ],
];
