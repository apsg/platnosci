<?php
namespace App\Domains\Payu\Elements;

use App\Domains\Payments\Models\Order;
use App\Domains\Payu\PayuHelper;

class OrderElement
{
    protected array $products = [];

    protected Order $order;

    protected Buyer $buyer;

    public function __construct(Order $order)
    {
        $this->order = $order;
        $this->products[] = new Product(
            name: $order->sale->description,
            unitPrice: $this->price(),
            quantity: 1);
        $this->buyer = new Buyer(
            email: $order->email,
            phone: $order->phone
        );
    }

    public function toArray(): array
    {
        return [
            'description' => $this->order->sale->description,
            'totalAmount' => $this->price(),
            'extOrderId'  => $this->order->hash,
            'buyer'       => $this->buyer->toArray(),
        ]
            + $this->productsToArray();
    }

    protected function price(): int
    {
        return PayuHelper::priceToCents($this->order->price);
    }

    protected function productsToArray(): array
    {
        return [
            'products' => array_map(function (Product $product) {
                return $product->toArray();
            }, $this->products),
        ];
    }
}
