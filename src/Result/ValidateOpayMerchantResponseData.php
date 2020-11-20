<?php


namespace Opay\Result;


class ValidateOpayMerchantResponseData
{
    private $merchantId;
    private $email;
    private $businessName;

    public static function cast(ValidateOpayMerchantResponseData $destination, ?\stdClass $source) : ValidateOpayMerchantResponseData
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
    public function getMerchantId()
    {
        return $this->merchantId;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getBusinessName()
    {
        return $this->businessName;
    }
}