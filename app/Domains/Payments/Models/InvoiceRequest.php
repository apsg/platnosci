<?php
namespace App\Domains\Payments\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int        id
 * @property string     order_id
 * @property string     ip
 * @property string     name
 * @property string     address
 * @property Carbon     created_at
 * @property Carbon     updated_at
 *
 * @property-read Order order
 */
class InvoiceRequest extends Model
{
    protected $fillable = [
        'order_id',
        'nip',
        'name',
        'address',
    ];

    public function order() : BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
