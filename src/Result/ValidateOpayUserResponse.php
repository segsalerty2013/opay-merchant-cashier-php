<?php


namespace Opay\Result;


class ValidateOpayUserResponse extends Response
{
    static function parseData(?\stdClass $s)
    {
        return ValidateOpayUserResponseData::cast(new ValidateOpayUserResponseData(), $s);
    }

    /**
     * @return ValidateOpayUserResponseData
     */
    public function getData() : ValidateOpayUserResponseData
    {
        return $this->data;
    }
}