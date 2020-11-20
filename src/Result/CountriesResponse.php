<?php


namespace Opay\Result;


class CountriesResponse extends Response
{

    static function parseData(?\stdClass $s)
    {
        return CountriesResponseData::cast(new CountriesResponseData(), $s);
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }
}