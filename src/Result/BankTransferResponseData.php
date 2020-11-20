<?php


namespace Opay\Result;


class BankTransferResponseData
{
    private $reference;
    private $orderNo;
    private $amount;
    private $currency;
    private $fee;
    private $status;
    private $failureReason;
    private $bankCode;
    private $bankAccountNumber;

    public static function cast(BankTransferResponseData $destination, ?\stdClass $source) : BankTransferResponseData
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
    public function getReference()
    {
        return $this->reference;
    }

    /**
     * @return mixed
     */
    public function getOrderNo()
    {
        return $this->orderNo;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * @return mixed
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * @return mixed
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * @return mixed
     */
    public function getFailureReason()
    {
        return $this->failureReason;
    }

    /**
     * @return mixed
     */
    public function getBankCode()
    {
        return $this->bankCode;
    }

    /**
     * @return mixed
     */
    public function getBankAccountNumber()
    {
        return $this->bankAccountNumber;
    }
}