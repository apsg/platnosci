<?php
namespace App\Domains\Invoices;

use App\Domains\Payments\Models\InvoiceRequest;
use App\Domains\Invoices\Client\InvoiceOceanClient;
use Carbon\Carbon;
use Exception;
use InvalidArgumentException;

class Invoice
{
    protected InvoiceRequest $request;
    protected InvoiceOceanClient $client;

    public function __construct(InvoiceRequest $request)
    {
        $this->request = $request;
        $provider = $request->provider;

        if (empty($provider)) {
            throw new InvalidArgumentException('No invoice provider selected');
        }

        $this->client = new InvoiceOceanClient(
            config("invoice.providers.{$provider}.url"),
            config("invoice.providers.{$provider}.token")
        );
    }

    public function generate(): int|string
    {
        if ($this->request->hasInvoice()) {
            return $this->request->external_id;
        }

        $response = $this->client->addInvoice($this->getAttributes());

        dd($response);

        if ($this->isInvalidResponse($response)) {
            throw new Exception('Invalid invoice data');
        }

        return data_get($response, 'response.id');
    }

    protected function getAttributes(): array
    {
        $now = Carbon::now()->format('Y-m-d');

        return [
            'kind'             => 'vat',
            'number'           => null,
            'sell_date'        => $this->request->order->created_at->format('Y-m-d'),
            'issue_date'       => $now,
            'payment_to'       => $this->request->order->created_at->format('Y-m-d'),
            'seller_name'      => 'IT&Business Training Mateusz Grabowski',
            'seller_street'    => 'ul. Zygmunta Starego 1/3',
            'seller_post_code' => '44-100',
            'seller_city'      => 'Gliwice',
            'seller_tax_no'    => '631-227-39-46',
            'buyer_name'       => $this->getName(),
            'buyer_email'      => $this->request->order->email,
            'buyer_tax_no'     => $this->request->nip,
            'positions'        => $this->getPositions(),
            'paid_date'        => $this->request->order->created_at->format('Y-m-d'),
            'status'           => 'paid',
            'gtu_codes'        => ['GTU_12'],
        ];
    }

    protected function getPositions(): array
    {
        return [
            [
                'name'              => $this->request->order->sale->description,
                'tax'               => 23,
                'total_price_gross' => $this->request->order->price,
                'quantity'          => 1,
            ],
        ];
    }

    protected function getName(): string
    {
        return implode(', ', [
            $this->request->name,
            $this->request->address,
        ]);
    }

    protected function isInvalidResponse(array $response): bool
    {
        if (!isset($response['success'])) {
            return true;
        }

        if ($response['success'] !== true) {
            return true;
        }

        if (data_get($response, 'response.code') === 'error') {
            return true;
        }

        return false;
    }
}
