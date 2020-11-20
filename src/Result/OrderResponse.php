<?php

namespace Opay\Result;

class OrderResponse extends Response
{

    static function parseData(?\stdClass $s)
    {
        return OrderResponseData::cast(new OrderResponseData(), $s);
    }

    /**
     * @return OrderResponseData
     */
    public function getData() : OrderResponseData
    {
        return $this->data;
    }

}