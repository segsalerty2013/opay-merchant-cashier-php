<?php


namespace Opay\Payload;


class ValidateOpayMerchantRequest implements \JsonSerializable
{
    private $email;

    public function __construct(string $email)
    {
        $this->email = $email;
    }

    public function jsonSerialize() : array
    {
        return [
            'email'=> $this->email
        ];
    }
}