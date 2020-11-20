<?php


namespace Opay\Result;


class BanksResponse extends Response
{
    static function parseData(?\stdClass $s)
    {
        return BanksResponseData::cast(new BanksResponseData(), $s);
    }

    /**
     * @return array
     */
    public function getData() : array
    {
        return $this->data;
    }
}