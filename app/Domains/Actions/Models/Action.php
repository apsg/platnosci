<?php
namespace App\Domains\Actions\Models;

use App\Domains\Actions\Jobs\AccessJob;
use App\Domains\Actions\Jobs\BaselinkerJob;
use App\Domains\Actions\Jobs\FullAccessJob;
use App\Domains\Actions\Jobs\InvoiceJob;
use App\Domains\Actions\Jobs\LifetimeAccessJob;
use App\Domains\Actions\Jobs\MailerliteJob;
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
 * @property-read Sale sale
 */
class Action extends Model
{
    use HasFactory;

    const TYPE_SUCCESS = 'success';
    const TYPE_FAIL = 'fail';
    const ACTION_ACCESS = 'access';
    const ACTION_FULLACCESS = 'fullaccess';
    const ACTION_LIFETIME_ACCESS = 'lifetime';
    const ACTION_INVOICE = 'invoice';
    const ACTION_MAILERLITE = 'mailerlite';
    const ACTION_BASELINKER = 'baselinker';

    protected $fillable = [
        'sale_id',
        'type',
        'job',
        'parameters',
    ];

    protected $casts = [
        'parameters' => 'array',
    ];

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function scopeOnSuccess(Builder $builder): Builder
    {
        return $builder->where('type', static::TYPE_SUCCESS);
    }

    public function scopeOnFail(Builder $builder): Builder
    {
        return $builder->where('type', static::TYPE_FAIL);
    }

    public static function getFactory(): ActionFactory
    {
        return ActionFactory::new();
    }

    public function getType(): string
    {
        return match ($this->job) {
            AccessJob::class         => static::ACTION_ACCESS,
            FullAccessJob::class     => static::ACTION_FULLACCESS,
            LifetimeAccessJob::class => static::ACTION_LIFETIME_ACCESS,
            BaselinkerJob::class     => static::ACTION_BASELINKER,
            MailerliteJob::class     => static::ACTION_MAILERLITE,
            InvoiceJob::class        => static::ACTION_INVOICE,
            default                  => '',
        };
    }
}
