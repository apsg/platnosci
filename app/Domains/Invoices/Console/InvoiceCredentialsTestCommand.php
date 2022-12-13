<?php
namespace App\Domains\Invoices\Console;

use App\Domains\Invoices\Client\InvoiceOceanClient;
use Illuminate\Console\Command;
use Illuminate\Support\Arr;

class InvoiceCredentialsTestCommand extends Command
{
    protected $signature = 'invoices:test';

    public function __invoke()
    {
        $providers = array_keys(config('invoice.providers'));

        $provider = $this->choice('Select provider to test', $providers);

        $client = new InvoiceOceanClient(
            config("invoice.providers.{$provider}.url"),
            config("invoice.providers.{$provider}.token")
        );

        $response = $client->getClients();
        $this->info('Connection correct');

        if (Arr::get($response, 'response_code') === 200) {
            $this->info('Response correct');
        } else {
            dump($response);
        }
    }
}
