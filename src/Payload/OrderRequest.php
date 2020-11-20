<?php

namespace Opay\Payload;

use Opay\Utility\OpayConstants;

class OrderRequest implements \JsonSerializable
{
    private $payMethods;
    private $reference;
    private $productDesc;
    private $payTypes;
    private $amount;
    private $currency;
    private $userPhone;
    private $userRequestIp;
    private $callbackUrl;
    private $returnUrl;
    private $mchShortName;
    private $productName;
    private $expireAt;

    public function __construct(array $paymentMethods, string $reference,
                                string $productDesc, array $payChannels,
                                string $payCurrency, string $payAmount,
                                string $userPhone, string $userRequestIp,
                                string $callbackUrl, string $returnUrl,
                                string $mchShortName, string $productName, int $expireAt = 0)
    {
        $this->payMethods = $paymentMethods;
        $this->reference = $reference;
        $this->productDesc = $productDesc;
        $this->payTypes = $payChannels;
        $this->amount = $payAmount;
        $this->currency = $payCurrency;
        $this->userPhone = $userPhone;
        $this->userRequestIp = $userRequestIp;
        $this->callbackUrl = $callbackUrl;
        $this->returnUrl = $returnUrl;
        $this->mchShortName = $mchShortName;
        $this->productName = $productName;
        if ($expireAt) {
            $this->expireAt = (string) $expireAt;
        } else {
            // use the default
            $this->expireAt = (string) OpayConstants::ORDER_EXPIRY;
        }
    }

    /**
     * @return string
     */
    public function getReference(): string
    {
        return $this->reference;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4.0
     */
    public function jsonSerialize() : array
    {
        return [
            'payMethods'=> $this->payMethods,
            'payTypes'=> $this->payTypes,
            'userRequestIp'=> $this->userRequestIp,
            'expireAt'=> $this->expireAt,
            'mchShortName'=> $this->mchShortName,
            'productName'=> $this->productName,
            'reference'=> $this->reference,
            'productDesc'=> $this->productDesc,
            'amount'=> $this->amount,
            'userPhone'=> $this->userPhone,
            'currency'=> $this->currency,
            'callbackUrl'=> $this->callbackUrl,
            'returnUrl'=> $this->returnUrl
        ];
    }

    /**
     * @return array
     */
    public function getPayMethods(): array
    {
        return $this->payMethods;
    }

    /**
     * @param array $payMethods
     */
    public function setPayMethods(array $payMethods): void
    {
        $this->payMethods = $payMethods;
    }

    /**
     * @return string
     */
    public function getProductDesc(): string
    {
        return $this->productDesc;
    }

    /**
     * @param string $productDesc
     */
    public function setProductDesc(string $productDesc): void
    {
        $this->productDesc = $productDesc;
    }

    /**
     * @return array
     */
    public function getPayTypes(): array
    {
        return $this->payTypes;
    }

    /**
     * @param array $payTypes
     */
    public function setPayTypes(array $payTypes): void
    {
        $this->payTypes = $payTypes;
    }

    /**
     * @return mixed
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * @param mixed $payAmount
     */
    public function setAmount(string $payAmount): void
    {
        $this->amount = $payAmount;
    }

    /**
     * @return string
     */
    public function getUserPhone(): string
    {
        return $this->userPhone;
    }

    /**
     * @param string $userPhone
     */
    public function setUserPhone(string $userPhone): void
    {
        $this->userPhone = $userPhone;
    }

    /**
     * @return string
     */
    public function getUserRequestIp(): string
    {
        return $this->userRequestIp;
    }

    /**
     * @param string $userRequestIp
     */
    public function setUserRequestIp(string $userRequestIp): void
    {
        $this->userRequestIp = $userRequestIp;
    }

    /**
     * @return string
     */
    public function getCallbackUrl(): string
    {
        return $this->callbackUrl;
    }

    /**
     * @param string $callbackUrl
     */
    public function setCallbackUrl(string $callbackUrl): void
    {
        $this->callbackUrl = $callbackUrl;
    }

    /**
     * @return string
     */
    public function getReturnUrl(): string
    {
        return $this->returnUrl;
    }

    /**
     * @param string $returnUrl
     */
    public function setReturnUrl(string $returnUrl): void
    {
        $this->returnUrl = $returnUrl;
    }

    /**
     * @return string
     */
    public function getMchShortName(): string
    {
        return $this->mchShortName;
    }

    /**
     * @param string $mchShortName
     */
    public function setMchShortName(string $mchShortName): void
    {
        $this->mchShortName = $mchShortName;
    }

    /**
     * @return string
     */
    public function getProductName(): string
    {
        return $this->productName;
    }

    /**
     * @param string $productName
     */
    public function setProductName(string $productName): void
    {
        $this->productName = $productName;
    }

    /**
     * @return string
     */
    public function getExpireAt(): string
    {
        return $this->expireAt;
    }

    /**
     * @param string $expireAt
     */
    public function setExpireAt(string $expireAt): void
    {
        $this->expireAt = $expireAt;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

    /**
     * @param string $currency
     */
    public function setCurrency(string $currency): void
    {
        $this->currency = $currency;
    }

}