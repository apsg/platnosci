<?php

use App\Domains\Actions\Jobs\AccessJob;
use App\Domains\Actions\Jobs\InvoiceJob;
use App\Domains\Actions\Jobs\MailerliteJob;

return [
    'access' => [
        'name'      => 'Dostęp do kursu',
        'job'       => AccessJob::class,
        'providers' => [
            'inauka' => [
                'url' => env('INTEGRATIONS_INAUKA_URL', 'https://inauka.pl'),
            ],

            'projekt30' => [
                'url' => env('INTEGRATIONS_PROJEKT30_URL', 'https://projekt30.pl'),
            ],
        ],
    ],

    'invoice' => [
        'name'      => 'Wystawianie faktury',
        'job'       => InvoiceJob::class,
        'providers' => [
            'tmgfv' => [
                'url'   => env('FAKTUROWNIA_URL'),
                'token' => env('FAKTUROWNIA_TOKEN'),
            ],
        ],
    ],

    'mailerlite' => [
        'name'      => 'Lista Mailerlite',
        'job'       => MailerliteJob::class,
        'providers' => [

        ],
    ],

];
