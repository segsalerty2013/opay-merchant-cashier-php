<?php


namespace Opay\Result;


class OpayTransferResponse extends Response
{
    static function parseData(?\stdClass $s)
    {
        return OpayTransferResponseData::cast(new OpayTransferResponseData(), $s);
    }

    /**
     * @return OpayTransferResponseData
     */
    public function getData() : OpayTransferResponseData
    {
        return $this->data;
    }
}