<?php


namespace Opay\Result;


class ValidateBankAccountResponseData
{
    private $accountNo;
    private $accountName;

    public static function cast(ValidateBankAccountResponseData $destination, ?\stdClass $source) : ValidateBankAccountResponseData
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
    public function getAccountNo()
    {
        return $this->accountNo;
    }

    /**
     * @return mixed
     */
    public function getAccountName()
    {
        return $this->accountName;
    }
}