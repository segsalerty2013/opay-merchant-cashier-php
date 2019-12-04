<?php

namespace Opay\Payload;

class OrderStatusRequest implements \JsonSerializable
{
    private $orderNo;
    private $reference;

    public function __construct(string $orderNo, string $reference)
    {
        $this->orderNo = $orderNo;
        $this->reference = $reference;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() : array
    {
        return [
            'orderNo'=> $this->orderNo,
            'reference'=> $this->reference
        ];
    }
}