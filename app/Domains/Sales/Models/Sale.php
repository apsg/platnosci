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
 * @property double                           price
 * @property double|null                      full_price
 * @property Carbon                           created_at
 * @property Carbon                           updated_at
 *
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
    ];

    public function url() : string
    {
        return route('sales.show', $this);
    }

    public function actions() : HasMany
    {
        return $this->hasMany(Action::class);
    }

    public static function newFactory() : SaleFactory
    {
        return SaleFactory::new();
    }
}
