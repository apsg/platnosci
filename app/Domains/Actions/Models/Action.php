<?php
namespace App\Domains\Actions\Models;

use App\Domains\Actions\DTO\AccessParameters;
use App\Domains\Sales\Models\Sale;
use Carbon\Carbon;
use Database\Factories\ActionFactory;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int       id
 * @property int       sale_id
 * @property string    type
 * @property string    job
 * @property array     parameters
 * @property Carbon    created_at
 * @property Carbon    updated_at
 *
 * @property-read Sale sale
 */
class Action extends Model
{
    use HasFactory;

    const TYPE_SUCCESS = 'success';
    const TYPE_FAIL = 'fail';

    protected $fillable = [
        'sale_id',
        'type',
        'job',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];

    public function sale() : BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function scopeOnSuccess(Builder $builder) : Builder
    {
        return $builder->where('type', static::TYPE_SUCCESS);
    }

    public function scopeOnFail(Builder $builder) : Builder
    {
        return $builder->where('type', static::TYPE_FAIL);
    }

    public static function getFactory() : ActionFactory
    {
        return ActionFactory::new();
    }
}
