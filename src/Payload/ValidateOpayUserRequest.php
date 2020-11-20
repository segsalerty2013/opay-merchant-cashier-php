<?php


namespace Opay\Payload;


class ValidateOpayUserRequest implements \JsonSerializable
{
    private $phoneNumber;

    public function __construct(string $phoneNumber)
    {
        $this->phoneNumber = $phoneNumber;
    }

    public function jsonSerialize() : array
    {
        return [
            'phoneNumber'=> $this->phoneNumber
        ];
    }
}