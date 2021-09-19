<?php
namespace App\Domains\Payments\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int         id
 * @property string      name
 * @property string      description
 * @property string      email
 * @property float       amount
 * @property Carbon|null confirmed_at
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class PaymentRequest extends Model
{
    protected $fillable = [
        'name',
        'description',
        'email',
        'amount',
        'confirmed_at',
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
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
}
