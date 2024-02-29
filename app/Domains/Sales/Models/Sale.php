<?php
namespace App\Domains\Sales\Models;

use App\Domains\Actions\Models\Action;
use App\Domains\Payments\Models\Order;
use App\Models\User;
use Carbon\Carbon;
use Database\Factories\SaleFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int                              id
 * @property int                              user_id
 * @property string                           hash
 * @property string                           name
 * @property string|null                      title
 * @property string                           description
 * @property string|null                      rules_url
 * @property string|null                      policy_url
 * @property string|null                      redirect_url
 * @property string|null                      icon_url
 * @property float                            price
 * @property float|null                       full_price
 * @property float|null                       omnibus_price
 * @property int|null                         counter
 * @property string|null                      payments_provider
 * @property string|null                      default_invoice_provider
 * @property Carbon                           created_at
 * @property Carbon                           updated_at
 * @property-read Collection<Action>|Action[] actions
 * @property-read Collection<Order>           orders
 */
class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'name',
        'description',
        'rules_url',
        'policy_url',
        'redirect_url',
        'price',
        'full_price',
        'counter',
        'payments_provider',
        'default_invoice_provider',
        'user_id',
        'omnibus_price',
        'icon_url',
        'title',
    ];

    protected $casts = [
        'id'      => 'integer',
        'user_id' => 'integer',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function url(): string
    {
        return route('sales.show', $this);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class)->orderBy('job');
    }

    public function orders(): HasMany
    {
        return $this->hasMany(Order::class);
    }

    public static function newFactory(): SaleFactory
    {
        return SaleFactory::new();
    }

    public function format(string $parameter): string
    {
        return number_format($this->getAttribute($parameter), 2);
    }

    public function scopeForUser(Builder $builder, User $user): Builder
    {
        return $builder->where('user_id', $user->id);
    }

    public function hasIcon(): bool
    {
        return !empty($this->icon_url);
    }
}
