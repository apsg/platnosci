<?php
namespace App\Domains\Payments\Models;

use App\Domains\Sales\Models\Sale;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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
 * @property int|null            actions_count
 * @property int|null            delivered_count
 * @property-read Sale           sale
 * @property-read InvoiceRequest invoice_request
 *
 * @method static Builder forUser(User $user)
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
        'actions_count',
        'delivered_count',
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

    public function hasRedirect(): bool
    {
        return !empty($this->sale->redirect_url);
    }

    public function isCancelled(): bool
    {
        return $this->cancelled_at !== null;
    }

    public function getPriceInCents(): int
    {
        return floor(100 * $this->price);
    }

    public function scopeForUser(Builder $builder, User $user): Builder
    {
        if ($user->id === 1) {
            return $builder;
        }

        return $builder->whereHas('sale', function (Builder $query) use ($user) {
            return $query->where('user_id', $user->id);
        });
    }
}
