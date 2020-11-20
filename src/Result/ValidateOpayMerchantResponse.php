<?php


namespace Opay\Result;


class ValidateOpayMerchantResponse extends Response
{
    static function parseData(?\stdClass $s)
    {
        return ValidateOpayMerchantResponseData::cast(new ValidateOpayMerchantResponseData(), $s);
    }

    /**
     * @return ValidateOpayMerchantResponseData
     */
    public function getData() : ValidateOpayMerchantResponseData
    {
        return $this->data;
    }
}