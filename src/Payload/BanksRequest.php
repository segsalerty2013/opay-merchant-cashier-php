<?php


namespace Opay\Payload;


class BanksRequest implements \JsonSerializable
{
    private $countryCode;

    public function __construct(string $countryCode)
    {
        $this->countryCode = $countryCode;
    }

    public function jsonSerialize() : array
    {
        return [
            'countryCode'=> $this->countryCode
        ];
    }
}