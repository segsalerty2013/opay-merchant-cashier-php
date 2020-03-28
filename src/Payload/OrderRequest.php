<?php

namespace Opay\Payload;

use Opay\Utility\OpayConstants;

class OrderRequest implements \JsonSerializable
{
    private $payMethods;
    private $reference;
    private $productDesc;
    private $payChannels;
    private $payAmount;
    private $userMobile;
    private $userRequestIp;
    private $callbackUrl;
    private $returnUrl;
    private $mchShortName;
    private $productName;
    private $orderExpireAt;

    public function __construct(array $paymentMethods, string $reference,
                                string $productDesc, array $payChannels,
                                string $payCurrency, string $payAmount,
                                string $userMobile, string $userRequestIp,
                                string $callbackUrl, string $returnUrl,
                                string $mchShortName, string $productName)
    {
        $this->payMethods = $paymentMethods;
        $this->reference = $reference;
        $this->productDesc = $productDesc;
        $this->payChannels = $payChannels;
        $this->payAmount = json_decode(json_encode([
            'value'=> $payAmount,
            'currency'=> $payCurrency
        ]));
        $this->userMobile = $userMobile;
        $this->userRequestIp = $userRequestIp;
        $this->callbackUrl = $callbackUrl;
        $this->returnUrl = $returnUrl;
        $this->mchShortName = $mchShortName;
        $this->productName = $productName;
        $this->orderExpireAt = (string) OpayConstants::ORDER_EXPIRY;
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
            'payChannels'=> $this->payChannels,
            'userRequestIp'=> $this->userRequestIp,
            'orderExpireAt'=> $this->orderExpireAt,
            'mchShortName'=> $this->mchShortName,
            'productName'=> $this->productName,
            'reference'=> $this->reference,
            'productDesc'=> $this->productDesc,
            'payAmount'=> $this->payAmount,
            'userMobile'=> $this->userMobile,
            'currency'=> $this->payAmount->currency,
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
    public function getPayChannels(): array
    {
        return $this->payChannels;
    }

    /**
     * @param array $payChannels
     */
    public function setPayChannels(array $payChannels): void
    {
        $this->payChannels = $payChannels;
    }

    /**
     * @return mixed
     */
    public function getPayAmount()
    {
        return $this->payAmount;
    }

    /**
     * @param mixed $payAmount
     */
    public function setPayAmount(string $payCurrency, string $payAmount): void
    {
        $this->payAmount = json_decode(json_encode([
            'value'=> $payAmount,
            'currency'=> $payCurrency
        ]));
    }

    /**
     * @return string
     */
    public function getUserMobile(): string
    {
        return $this->userMobile;
    }

    /**
     * @param string $userMobile
     */
    public function setUserMobile(string $userMobile): void
    {
        $this->userMobile = $userMobile;
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
    public function getOrderExpireAt(): string
    {
        return $this->orderExpireAt;
    }

    /**
     * @param string $orderExpireAt
     */
    public function setOrderExpireAt(string $orderExpireAt): void
    {
        $this->orderExpireAt = $orderExpireAt;
    }

}