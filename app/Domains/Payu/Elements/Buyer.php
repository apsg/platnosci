<?php
namespace App\Domains\Payu\Elements;

class Buyer extends BaseElement
{
    public string $email;

    public ?string $phone = null;

    public ?string $firstName = null;

    public ?string $lastName = null;

    public function __construct(string $email, ?string $phone, ?string $firstName = null, ?string $lastName = null)
    {
        $this->email = $email;
        $this->phone = $phone;
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }
}
