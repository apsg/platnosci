<?php
namespace App\Domains\Invoices\Config;

use Illuminate\Support\Arr;

class Provider
{
    protected array $data = [];

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function getLumpSum(): string|float|null
    {
        return Arr::get($this->data, 'lump_sum_tax');
    }

    public function getSellerData(): array
    {
        return array_filter([
            'seller_name'      => Arr::get($this->data, 'name'),
            'seller_street'    => Arr::get($this->data, 'address'),
            'seller_post_code' => Arr::get($this->data, 'postcode'),
            'seller_city'      => Arr::get($this->data, 'city'),
            'seller_tax_no'    => Arr::get($this->data, 'nip'),
            'place'            => Arr::get($this->data, 'place'),
            'exempt_tax_kind'  => Arr::get($this->data, 'exempt_tax_kind'),
            'description'      => Arr::get($this->data, 'description'),
        ]);
    }

    public function getTaxRate(): int|string
    {
        return Arr::get($this->data, 'tax', 23);
    }

    public function getExcemptKind(): ?string
    {
        return Arr::get($this->data, 'exempt_tax_kind');
    }
}
