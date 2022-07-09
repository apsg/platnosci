<?php
namespace App\Domains\Payu;

class PayuHelper
{
    const ENV_TEST = 'sandbox';
    const ENV_PROD = 'secure';

    public static function priceToCents(float $price): int
    {
        return (int)floor(100 * $price);
    }
}
