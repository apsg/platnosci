<?php
namespace App\Domains\Payu;

use App\Domains\Payments\AbstractPaymentsDriver;
use App\Domains\Payments\Models\Order;
use App\Domains\Payu\Elements\OrderElement;
use App\Domains\Payu\Exceptions\MissingOrderException;
use OpenPayU_Configuration;
use OpenPayU_Order;

class PayuDriver extends AbstractPaymentsDriver
{
    protected string $provider;

    protected Order $order;

    public function __construct(string $provider)
    {
        $this->provider = $provider;

        OpenPayU_Configuration::setEnvironment($this->getEnv());
        OpenPayU_Configuration::setMerchantPosId($this->getPosId());
        OpenPayU_Configuration::setSignatureKey($this->getMd5());
        OpenPayU_Configuration::setOauthClientId($this->getClientId());
        OpenPayU_Configuration::setOauthClientSecret($this->getSecret());
    }

    public function getPosId()
    {
        return config("payments.payu.{$this->provider}.pos_id");
    }

    public function getMd5()
    {
        return config("payments.payu.{$this->provider}.md5");
    }

    public function getSecondKey()
    {
        return $this->getMd5();
    }

    public function getClientId()
    {
        return config("payments.{$this->provider}.client_id");
    }

    public function getSecret()
    {
        return config("payments.{$this->provider}.secret");
    }

    public function getEnv()
    {
        return config("payments.{$this->provider}.env");
    }

    public function forOrder(Order $order): self
    {
        $this->order = $order;

        return $this;
    }

    public function getUrl(): string
    {
        if ($this->order === null) {
            throw new MissingOrderException;
        }

        $orderElement = new OrderElement($this->order);

        //        dd($orderElement->toArray(), $this->getDriverParameters());

        $response = OpenPayU_Order::create($orderElement->toArray() + $this->getDriverParameters());

        return $response->getResponse()->redirectUri;
    }

    protected function getContinueUrl(): string
    {
        return route('orders.continue', $this->order);
    }

    protected function getNotifyUrl(): string
    {
        return route('payu.ipn');
    }

    protected function getCurrencyCode(): string
    {
        return Currency::PLN;
    }

    protected function getDriverParameters(): array
    {
        return [
            'continueUrl'   => $this->getContinueUrl(),
            'notifyUrl'     => $this->getNotifyUrl(),
            'customerIp'    => request()->ip(),
            'merchantPosId' => config('payments.' . $this->provider . '.pos_id'),
            'currencyCode'  => $this->getCurrencyCode(),
        ];
    }

    public function verifySignature(string $payload, string $signature): bool
    {
        $expectedSignature = md5($payload . $this->getSecondKey());

        return $expectedSignature === $signature;
    }
}
