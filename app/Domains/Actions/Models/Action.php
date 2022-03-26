<?php
namespace App\Domains\Actions\Models;

use App\Domains\Actions\Jobs\ActionJob;
use App\Domains\Sales\Models\Sale;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
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

    public function job() : ActionJob
    {
        return new ($this->job)($this->parameters);
    }

    public function scopeOnSuccess(Builder $builder) : Builder
    {
        return $builder->where('type', static::TYPE_SUCCESS);
    }

    public function scopeOnFail(Builder $builder) : Builder
    {
        return $builder->where('type', static::TYPE_FAIL);
    }
}
