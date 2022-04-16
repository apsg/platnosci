<?php
namespace App\Domains\Payu\Elements;

class Product extends BaseElement
{
    public string $name;
    public int $unitPrice;
    public int $quantity = 1;

    public function __construct(string $name, int $unitPrice = 0, int $quantity = 1)
    {
        $this->name = $name;
        $this->unitPrice = $unitPrice;
        $this->quantity = $quantity;
    }
}
