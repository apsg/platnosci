<?php

use App\Domains\Actions\Jobs\AccessJob;
use App\Domains\Actions\Jobs\BaselinkerJob;
use App\Domains\Actions\Jobs\FullAccessJob;
use App\Domains\Actions\Jobs\MailerliteJob;
use App\Domains\Actions\Models\Action;

return [
    Action::ACTION_ACCESS => [
        'name'      => 'Dostęp do kursu',
        'job'       => AccessJob::class,
        'providers' => [
            'inauka'    => [
                'url' => env('INTEGRATIONS_INAUKA_URL', 'https://inauka.pl'),
                'key' => env('INAUKA_KEY'),
            ],
            'projekt30' => [
                'url' => env('INTEGRATIONS_PROJEKT30_URL', 'https://projekt30.pl'),
                'key' => env('PROJEKT30_KEY'),
            ],
            'techniczni' => [
                'url' => env('INTEGRATIONS_TECHNICZNI_URL', 'https://techniczni.pro'),
                'key' => env('TECHNICZNI_KEY'),
            ]
        ],
    ],

    Action::ACTION_FULLACCESS => [
        'name'      => 'Pełen roczny dostęp do platformy',
        'job'       => FullAccessJob::class,
        'providers' => [
            'inauka'    => [
                'url' => env('INTEGRATIONS_INAUKA_URL', 'https://inauka.pl'),
                'key' => env('INAUKA_KEY'),
            ],
            'projekt30' => [
                'url' => env('INTEGRATIONS_PROJEKT30_URL', 'https://projekt30.pl'),
                'key' => env('PROJEKT30_KEY'),
            ],
            'techniczni'    => [
                'url' => env('INTEGRATIONS_INAUKA_URL', 'https://techniczni.pro'),
                'key' => env('TECHNICZNI_KEY'),
            ],
        ],
    ],

    //    Action::ACTION_INVOICE => [
    //        'name'      => 'Wystawianie faktury',
    //        'job'       => InvoiceJob::class,
    //        'providers' => [
    //            'tmgfv' => [
    //                'url'   => env('FAKTUROWNIA_URL'),
    //                'token' => env('FAKTUROWNIA_TOKEN'),
    //            ],
    //        ],
    //    ],

    Action::ACTION_MAILERLITE => [
        'name'      => 'Lista Mailerlite',
        'job'       => MailerliteJob::class,
        'providers' => [
            'itbt' => [
                'token' => env('MAILERLITE_TOKEN'),
            ],
        ],
    ],

    Action::ACTION_BASELINKER => [
        'name'      => 'Baselinker',
        'job'       => BaselinkerJob::class,
        'providers' => [
            'itbt' => [
                'token' => env('BASELINKER_TOKEN'),
            ],
        ],
    ],
];
