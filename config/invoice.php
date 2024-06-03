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
        ],
        'imd'        => [
            'name'          => 'IMD Dariusz Skórniewski',
            'department_id' => '755066',
//            'nip'          => '9691395217',
//            'address'      => 'Brzozowa 10/3',
//            'postcode'     => '44-177',
//            'city'         => 'Paniówki',
//            'place'        => 'Paniówki',
            'url'           => env('FAKTUROWNIA_URL_IMD'),
            'token'         => env('FAKTUROWNIA_TOKEN_IMD'),
            'tax'          => 'zw',
            'lump_sum_tax' => '8,5',
//            'bank_account' => '21 1050 1298 1000 0097 4030 0059',
        ],
        'eduinf'     => [
            'name'         => 'Edukacja Informatyczna Sp. z o.o.',
            'nip'          => '6351867012',
            'address'      => 'ul. Rynek 2',
            'postcode'     => '43-190',
            'city'         => 'Mikołów',
            'place'        => 'Mikołów',
            'url'          => env('FAKTUROWNIA_URL_EI'),
            'token'        => env('FAKTUROWNIA_TOKEN_EI'),
            'tax'          => 'zw',
            'lump_sum_tax' => '8,5',
        ],
        'itbt' => [
            'name'          => 'IT&Business Training Mateusz Grabowski',
            'department_id' => '480394',
            'url'           => env('FAKTUROWNIA_URL_ITBT'),
            'token'         => env('FAKTUROWNIA_TOKEN_ITBT'),
            'tax'          => '23',
        ],
    ],
];
