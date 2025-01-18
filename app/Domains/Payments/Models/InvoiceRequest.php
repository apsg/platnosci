<?php
namespace App\Domains\Payments\Models;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int         id
 * @property string      order_id
 * @property string      ip
 * @property string      name
 * @property string      address
 * @property string      nip
 * @property string|null external_id
 * @property string|null provider
 * @property string|null postcode
 * @property string|null city
 * @property Carbon      created_at
 * @property Carbon      updated_at
 * @property Carbon|null accepted_at
 * @property Carbon|null date
 * @property-read Order  order
 *
 * @method static Builder pending()
 */
class InvoiceRequest extends Model
{
    protected $fillable = [
        'order_id',
        'nip',
        'name',
        'address',
        'accepted_at',
        'provider',
        'postcode',
        'city',
        'date',
    ];

    protected $dates = [
        'accepted_at',
        'date',
    ];

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }

    public function scopePending(Builder $builder): Builder
    {
        return $builder->whereNull('accepted_at');
    }

    public function hasInvoice(): bool
    {
        return !empty($this->external_id);
    }

    public function scopeForUser(Builder $builder, User $user): Builder
    {
        return $builder->whereHas('order.sale', function (Builder $query) use ($user) {
            return $query->where('user_id', $user->id);
        });
    }
}
