<?php
namespace App\Domains\Invoices;

use App\Domains\Invoices\Client\InvoiceOceanClient;
use App\Domains\Invoices\Config\Provider;
use App\Domains\Payments\Models\InvoiceRequest;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Log;
use InvalidArgumentException;

class Invoice
{
    protected InvoiceRequest $request;

    protected InvoiceOceanClient $client;

    protected $invoiceId = null;

    protected ?Provider $provider;

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

        $this->provider = new Provider(config("invoice.providers.{$provider}"));
    }

    public function generate(): int|string
    {
        if ($this->request->hasInvoice()) {
            return $this->request->external_id;
        }

        $attributes = $this->getAttributes();

        Log::info(__CLASS__, compact('attributes'));

        $response = $this->client->addInvoice($attributes);

        if ($this->isInvalidResponse($response)) {
            Log::error(__CLASS__, $response);
            throw new Exception('Invalid invoice data');
        }

        $this->invoiceId = data_get($response, 'response.id');

        return $this->invoiceId;
    }

    protected function getAttributes(): array
    {
        $now = Carbon::now()->format('Y-m-d');

        $attributes = [
                'kind'            => 'vat',
                'number'          => null,
                'sell_date'       => $this->request->order->created_at->format('Y-m-d'),
                'issue_date'      => $now,
                'payment_to'      => $this->request->order->created_at->format('Y-m-d'),
                'buyer_name'      => $this->request->name,
                'buyer_street'    => $this->request->address,
                'buyer_post_code' => $this->request->postcode,
                'buyer_city'      => $this->request->city,
                'buyer_email'     => $this->request->order->email,
                'buyer_tax_no'    => $this->request->nip,
                'positions'       => $this->getPositions(),
                'paid_date'       => $this->getPaidDate(),
                'status'          => 'paid',
                'gtu_codes'       => ['GTU_12'],
            ] + $this->provider->getSellerData();

        if (isset($attributes['department_id'])) {
            unset($attributes['seller_name']);
        }

        return $attributes;
    }

    protected function getPositions(): array
    {
        return [
            array_filter([
                'name'              => $this->request->order->sale->description,
                'tax'               => $this->provider->getTaxRate(),
                'total_price_gross' => $this->request->order->price,
                'quantity'          => 1,
                'quantity_unit'     => 'szt',
                'lump_sum_tax'      => $this->provider->getLumpSum(),
            ]),
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

    public function sendByEmail(): self
    {
        $this->client->sendInvoice($this->invoiceId);

        return $this;
    }

    protected function getPaidDate(): string
    {
        return $this->request->date !== null
            ? $this->request->date->format('y-m-d')
            : $this->request->order->created_at->format('Y-m-d');
    }
}
