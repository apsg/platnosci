<?php
namespace App\Domains\Payments;

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
}
