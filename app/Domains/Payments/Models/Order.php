<?php
namespace App\Domains\Payments\Models;

use App\Domains\Sales\Models\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         id
 * @property string      hash
 * @property string      email
 * @property string|null phone
 * @property int         sale_id
 * @property int         price
 * @property string|null external_id
 * @property Carbon|null confirmed_at
 * @property Carbon      created_at
 * @property Carbon      updated_at
 *
 * @property-read Sale   sale
 */
class Order extends Model
{
    protected $fillable = [
        'hash',
        'email',
        'phone',
        'sale_id',
        'price',
        'external_id',
        'confirmed_at',
    ];

    public function sale() : BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function isPaid() : bool
    {
        return $this->confirmed_at !== null;
    }
}
