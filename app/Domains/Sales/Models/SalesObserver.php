<?php
namespace App\Domains\Sales\Models;

use Illuminate\Support\Str;

class SalesObserver
{
    public function creating(Sale $sale)
    {
        if (!empty($sale->hash)) {
            return;
        }

        $sale->fill([
            'hash' => Str::lower(Str::random(16)),
        ]);
    }
}
