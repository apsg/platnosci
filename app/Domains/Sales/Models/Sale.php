<?php
namespace App\Domains\Sales\Models;

use App\Domains\Actions\Models\Action;
use Carbon\Carbon;
use Database\Factories\SaleFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

/**
 * @property int                              id
 * @property string                           hash
 * @property string                           name
 * @property string                           description
 * @property string|null                      rules_url
 * @property float                            price
 * @property float|null                       full_price
 * @property int|null                         counter
 * @property string|null                      payments_provider
 * @property string|null                      default_invoice_provider
 * @property Carbon                           created_at
 * @property Carbon                           updated_at
 * @property-read Collection<Action>|Action[] actions
 */
class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'hash',
        'name',
        'description',
        'rules_url',
        'price',
        'full_price',
        'counter',
        'payments_provider',
        'default_invoice_provider',
    ];

    public function url(): string
    {
        return route('sales.show', $this);
    }

    public function actions(): HasMany
    {
        return $this->hasMany(Action::class)->orderBy('job');
    }

    public static function newFactory(): SaleFactory
    {
        return SaleFactory::new();
    }

    public function format(string $parameter): string
    {
        return number_format($this->getAttribute($parameter), 2);
    }
}
