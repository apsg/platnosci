<?php
namespace App\Domains\Payu;

use App\Domains\Payments\Models\Order;
use App\Domains\Payu\Elements\OrderElement;
use Illuminate\Support\Arr;
use OpenPayU_Configuration;
use OpenPayU_Order;

class PayuDriver
{
    protected string $provider;
    protected Order $order;

    public function __construct(string $provider)
    {
        $this->provider = $provider;

        $config = config('payu.' . $provider);

        OpenPayU_Configuration::setEnvironment(Arr::get($config, 'env'));
        OpenPayU_Configuration::setMerchantPosId(Arr::get($config, 'pos_id'));
        OpenPayU_Configuration::setSignatureKey(Arr::get($config, 'md5'));
        OpenPayU_Configuration::setOauthClientId(Arr::get($config, 'client_id'));
        OpenPayU_Configuration::setOauthClientSecret(Arr::get($config, 'secret'));
    }

    public function forOrder(Order $order) : self
    {
        $this->order = $order;

        return $this;
    }

    public function getUrl() : string
    {
        $orderElement = new OrderElement($this->order);
//        dd($orderElement->toArray() + $this->getDriverParameters());
        $response = OpenPayU_Order::create($orderElement->toArray() + $this->getDriverParameters());

        return $response->getResponse()->redirectUri;
    }

    protected function getContinueUrl() : string
    {
        return route('orders.continue', $this->order);
    }

    protected function getNotifyUrl() : string
    {
        if (app()->environment('local')) {
            return env('NGROK_URL') . '/payu/ipn';
        }

        return route('payu.ipn');
    }

    protected function getMerchantPosId() : string
    {
        return config('payu.');
    }

    protected function getCurrencyCode() : string
    {
        return Currency::PLN;
    }

    protected function getDriverParameters() : array
    {
        return [
            'continueUrl'   => $this->getContinueUrl(),
            'notifyUrl'     => $this->getNotifyUrl(),
            'customerIp'    => request()->ip(),
            'merchantPosId' => config('payu.' . $this->provider . '.pos_id'),
            'currencyCode'  => $this->getCurrencyCode(),
        ];
    }
}
