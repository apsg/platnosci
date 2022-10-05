<?php

return [
    'providers' => [
//        'tmgfv' => [
//            'name'     => 'Business Intelligence Training Dariusz Skórniewski, Mateusz Grabowski Spółka Cywilna',
//            'nip'      => '9691646458',
//            'address'  => 'Brzozowa 10/3',
//            'postcode' => '44-177',
//            'city'     => 'Paniówki',
//            'url'      => env('FAKTUROWNIA_URL_MATEUSZ', 'https://tmgfv.fakturownia.pl'),
//            'token'    => env('FAKTUROWNIA_TOKEN_MATEUSZ'),
//            'tax'      => 23
//        ],
        'bitraining' => [
            'name'         => 'Business Intelligence Training Dariusz Skórniewski, Mateusz Grabowski Spółka Cywilna',
            'nip'          => '9691646458',
            'address'      => 'Brzozowa 10/3',
            'postcode'     => '44-177',
            'city'         => 'Paniówki',
            'place'        => 'Paniówki',
            'url'          => env('FAKTUROWNIA_URL_DARIUSZ'),
            'token'        => env('FAKTUROWNIA_TOKEN_DARIUSZ'),
            'tax'          => 'zw',
            'lump_sum_tax' => '8,5',
            'description'  => 'Zwolnienie ze względu na nieprzekroczenie 200 000 PLN obrotu (art. 113 ust 1 i 9 ustawy o VAT)',
        ],
        'potraining' => [
            'name'         => 'Professional Office Training Dariusz Skórniewski, Mateusz Grabowski Spółka Cywilna',
            'nip'          => '9691646441',
            'address'      => 'Brzozowa 10/3',
            'postcode'     => '44-177',
            'city'         => 'Paniówki',
            'place'        => 'Paniówki',
            'url'          => env('FAKTUROWNIA_URL_PO'),
            'token'        => env('FAKTUROWNIA_TOKEN_PO'),
            'tax'          => 'zw',
            'lump_sum_tax' => '8,5',
            'description'  => 'Zwolnienie ze względu na nieprzekroczenie 200 000 PLN obrotu (art. 113 ust 1 i 9 ustawy o VAT)',
        ],
    ],
];
