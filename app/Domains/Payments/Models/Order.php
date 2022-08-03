<?php
namespace App\Domains\Payments\Models;

use App\Domains\Sales\Models\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

/**
 * @property int                 id
 * @property string              hash
 * @property string              email
 * @property string|null         phone
 * @property int                 sale_id
 * @property float               price
 * @property string|null         external_id
 * @property Carbon|null         confirmed_at
 * @property Carbon|null         cancelled_at
 * @property Carbon              created_at
 * @property Carbon              updated_at
 * @property-read Sale           sale
 * @property-read InvoiceRequest invoice_request
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
        'cancelled_at',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function invoice_request(): HasOne
    {
        return $this->hasOne(InvoiceRequest::class);
    }

    public function isPaid(): bool
    {
        return $this->confirmed_at !== null;
    }

    public function isCancelled(): bool
    {
        return $this->cancelled_at !== null;
    }

    public function getPriceInCents(): int
    {
        return floor(100 * $this->price);
    }
}
