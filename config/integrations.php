<?php

use App\Domains\Actions\Jobs\AccessJob;

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

    'invoices' => [
        'name'      => 'Wystawianie faktury',
        'providers' => [],
    ],

    'mailerlite' => [
        'name'      => 'Lista Mailerlite',
        'providers' => [

        ],
    ],

];
