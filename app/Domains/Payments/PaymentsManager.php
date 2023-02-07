<?php
namespace App\Domains\Payments;

use App\Domains\P24\P24Driver;
use App\Domains\Payments\Exceptions\InvalidProviderException;
use App\Domains\Payu\PayuDriver;

class PaymentsManager
{
    const PAYU = 'payu';
    const P24 = 'p24';

    public static function listAvailableSystems(): array
    {
        return collect(config('payments'))
            ->map(function (array $data, string $name) {
                return [
                    'provider' => $name,
                    'driver'   => $data['driver'],
                    'name'     => $data['name'],
                ];
            })->toArray();
    }

    public static function resolve(string $provider): AbstractPaymentsDriver
    {
        $system = config("payments.{$provider}");

        if ($system === null) {
            throw new InvalidProviderException($provider);
        }

        switch ($system['driver']) {
            case static::PAYU:

                return new PayuDriver($provider);
            case static::P24:

                return new P24Driver($provider);
        }
    }
}
