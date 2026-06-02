<?php
namespace App\Domains\P24;

use App\Domains\Payments\AbstractPaymentsDriver;
use App\Domains\Payments\Models\Order;
use Illuminate\Support\Facades\Log;
use Przelewy24\Przelewy24;

class P24Driver extends AbstractPaymentsDriver
{
    protected Przelewy24 $client;

    protected Order $order;

    public function __construct(string $provider)
    {
        $this->client = new Przelewy24([
            'merchant_id' => config("payments.{$provider}.posid"),
            'crc'         => config("payments.{$provider}.token"),
            'live'        => config("payments.{$provider}.live"),
        ]);
    }

    public function forOrder(Order $order): AbstractPaymentsDriver
    {
        $this->order = $order;

        return $this;
    }

    public function getUrl(): string
    {
        $transactionData = $this->getTransactionData();

        Log::info(__CLASS__ . ' - creating transaction', [
            'transaction_data' => $transactionData,
        ]);

        return $this->client
            ->transaction($transactionData)
            ->redirectUrl();
    }

    protected function getTransactionData(): array
    {
        return [
            'session_id'  => $this->order->id,
            'url_return'  => route('orders.continue', $this->order),
            'url_status'  => route('p24.ipn', $this->order->sale->payments_provider),
            'amount'      => $this->order->getPriceInCents(),
            'description' => $this->order->sale->name,
            'email'       => $this->order->email,
        ];
    }

    public function getClient(): Przelewy24
    {
        return $this->client;
    }
}
