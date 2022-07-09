<?php
namespace App\Domains\Payu\Requests;

use Illuminate\Foundation\Http\FormRequest;

class IpnRequest extends FormRequest
{
    const COMPLETED = 'COMPLETED';
    const CANCELLED = 'CANCELED';
    const SIGNATURE_HEADER = 'X-OpenPayU-Signature';

    public function rules()
    {
        return [];
    }

    public function hash(): string
    {
        return $this->input('order.extOrderId', '');
    }

    public function externalId(): string
    {
        return $this->input('order.orderId', '');
    }

    public function isStatusCompleted(): bool
    {
        return $this->input('order.status') === static::COMPLETED;
    }

    public function isStatusCanceled(): bool
    {
        return $this->input('order.status') === static::CANCELLED;
    }

    public function getSignature(): string
    {
        $signatureHeader = explode(';', $this->header(static::SIGNATURE_HEADER));

        foreach ($signatureHeader as $item) {
            [$key, $value] = explode('=', $item);

            if ($key === 'signature') {
                return $value;
            }
        }

        return '';
    }
}
