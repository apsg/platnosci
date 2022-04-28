<?php
namespace App\Domains\Sales\Models;

use Illuminate\Support\Str;

class SalesObserver
{
    public function creating(Sale $sale)
    {
        if (empty($sale->hash)) {
            $sale->fill([
                'hash' => Str::lower(Str::random(16)),
            ]);
        }

        if ($sale->counter === '') {
            $sale->fill([
                'counter' => null,
            ]);
        }
    }

    public function saving(Sale $sale)
    {
        if ($sale->counter === '') {
            $sale->fill([
                'counter' => null,
            ]);
        }
    }
}
