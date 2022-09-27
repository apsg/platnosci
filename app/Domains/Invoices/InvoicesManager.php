<?php
namespace App\Domains\Invoices;

class InvoicesManager
{
    public static function listAvailableSystems(): array
    {
        return collect(config('invoice.providers'))
            ->map(function (array $data, string $name) {
                return [
                    'provider' => $name,
                    'name'     => $data['name'],
                ];
            })->toArray();
    }
}
