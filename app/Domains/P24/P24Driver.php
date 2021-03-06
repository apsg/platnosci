<?php
namespace App\Domains\P24;

use App\Domains\Payments\AbstractPaymentsDriver;
use App\Domains\Payments\Models\Order;
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
        return $this->client
            ->transaction($this->getTransactionData())
            ->redirectUrl();
    }

    protected function getTransactionData(): array
    {
        return [
            'session_id'  => $this->order->id,
            'url_return'  => route('orders.continue', $this->order),
            'url_status'  => route('p24.ipn'),
            'amount'      => $this->getPrice(),
            'description' => $this->order->sale->name,
            'email'       => $this->order->email,
        ];
    }

    protected function getPrice(): int
    {
        return floor(100 * $this->order->price);
    }
}
