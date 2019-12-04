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
}