<?php
namespace App\Domains\Sales\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int         id
 * @property string      hash
 * @property string      name
 * @property string      description
 * @property string|null rules_url
 * @property double      price
 * @property double|null full_price
 * @property Carbon      created_at
 * @property Carbon      updated_at
 */
class Sale extends Model
{
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
}
