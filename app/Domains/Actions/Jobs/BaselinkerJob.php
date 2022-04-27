<?php
namespace App\Domains\Actions\Jobs;

use App\Domains\Actions\ActionsHelper;
use App\Domains\Actions\Models\Action;
use Apsg\Baselinker\Baselinker\Orders;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log;

class BaselinkerJob extends ActionJob
{
    public function handle() : void
    {
        $orderData = $this->getOrderPayload();
        $token = $this->getProviderKey();
        $response = (new Orders(new Client(), $token))
            ->addOrder($orderData);
        Log::info(__CLASS__, compact('orderData', 'token', 'response'));
    }

    protected function getOrderPayload() : array
    {
        return [
            'email'            => $this->order->email,
            'invoice_fullname' => ActionsHelper::emailToName($this->order->email),
            'phone'            => $this->order->phone,
            'paid'             => 1,
            'products'         => [
                [
                    'storage'      => 'db',
                    'storage_id'   => 0,
                    'product_id'   => Arr::get($this->parameters, 'product_id'),
                    'quantity'     => 1,
                    'price_brutto' => number_format($this->order->price, 2, '.', ''),
                    'name'         => $this->order->sale->name,
                ],
            ],
            'date_add'         => $this->order->confirmed_at->timestamp ?? now()->timestamp,
            'order_status_id'  => Orders::NEW_ORDER_STATUS,
        ];
    }

    private function getProviderKey() : string
    {
        return config('integrations.'
            . Action::ACTION_BASELINKER
            . '.providers.'
            . $this->provider()
            . '.token');
    }
}
