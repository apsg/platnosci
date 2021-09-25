<?php
namespace App\Domains\Payments\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int         id
 * @property string|null slug
 * @property string      name
 * @property string      description
 * @property string      email
 * @property float       amount
 * @property string      rules_url
 * @property Carbon|null confirmed_at
 * @property Carbon|null last_email_sent_at
 * @property Carbon      created_at
 * @property Carbon      updated_at
 *
 * @property-read string url
 */
class PaymentRequest extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'email',
        'amount',
        'confirmed_at',
        'slug',
        'rules_url',
        'last_email_sent_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];

    protected $appends = [
        'url',
    ];

    public function confirm() : self
    {
        if ($this->confirmed_at === null) {
            $this->update([
                'confirmed_at' => Carbon::now(),
            ]);
        }

        return $this;
    }

    public function isConfirmed() : bool
    {
        return !empty($this->confirmed_at);
    }

    public function isEditable() : bool
    {
        return !$this->isConfirmed();
    }

    public function getUrlAttribute() : string
    {
        return url('/p/' . $this->slug);
    }

    public function getAmountFormattedAttribute() : string
    {
        return number_format($this->amount, 2, '.', ' ');
    }

    public function scopeConfirmed($query) : Builder
    {
        return $query->whereNotNull('confirmed_at');
    }
}
