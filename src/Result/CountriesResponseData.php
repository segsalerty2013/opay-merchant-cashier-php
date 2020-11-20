<?php


namespace Opay\Result;


class CountriesResponseData
{
    public $name;
    public $code;
    public $currency;

    public static function cast(CountriesResponseData $destination, ?\stdClass $source) : CountriesResponseData
    {
        if ($source) {
            $sourceReflection = new \ReflectionObject($source);
            $sourceProperties = $sourceReflection->getProperties();
            foreach ($sourceProperties as $sourceProperty) {
                $name = $sourceProperty->getName();
                $destination->{$name} = $source->$name;
            }
        }
        return $destination;
    }

    public function toArray() : array {
        return (array) $this;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }
}
