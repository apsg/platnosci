<?php
namespace App\Domains\Payu\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IpnRequest extends FormRequest
{
    const COMPLETED = 'COMPLETED';

    public function rules()
    {
        return [];
    }

    public function hash() : string
    {
        return $this->input('order.extOrderId', '');
    }

    public function externalId() : string
    {
        return $this->input('order.orderId', '');
    }

    public function isStatusCompleted() : bool
    {
        return $this->input('order.status') === static::COMPLETED;
    }
}
