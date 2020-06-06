<?php

namespace Opay;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Opay\Payload\OrderCloseRequest;
use Opay\Payload\OrderRequest;
use Opay\Payload\OrderStatusRequest;
use Opay\Result\OrderResponse;

class MerchantCashier
{

    private $merchantId;

    private $orderData;
    private $orderStatusData;
    private $orderCloseData;

    private $networkClient;

    private $publicKey;
    private $privateKey;

    private $proxyAddress;

    public function __construct(string $environmentBaseUrl, string $pbKey, string $pvKey,
                                string $merchantId, ?array $proxyAddress = null) {
        $this->merchantId = $merchantId;
        $this->publicKey = $pbKey;
        $this->privateKey = $pvKey;
        $this->networkClient = new Client([
            'base_uri'=> $environmentBaseUrl
        ]);
        $this->proxyAddress = $proxyAddress;
    }

    private function buildRequestOptions(array $options) : array {
        if ($this->proxyAddress) {
            $options[RequestOptions::PROXY] = $this->proxyAddress;
        }
        return $options;
    }

    public final function order(OrderRequest $order) : void {
        $this->orderData = $order;
    }

    public final function orderStatus(OrderStatusRequest $orderStatus) : void {
        $this->orderStatusData = $orderStatus;
    }

    public final function orderClose(OrderCloseRequest $orderClose) : void {
        $this->orderCloseData = $orderClose;
    }

    public final function getOrderApiResult() : ?OrderResponse {
        $response = $this->networkClient->post('/api/v3/cashier/initialize', $this->buildRequestOptions([
            RequestOptions::JSON=> $this->orderData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$this->publicKey,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return OrderResponse::cast(new OrderResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function getOrderStatusApiResult() : ?OrderResponse {
        $_signature = hash_hmac('sha512', json_encode($this->orderStatusData) , $this->privateKey);
        $response = $this->networkClient->post("/api/v3/cashier/status",$this->buildRequestOptions([
            RequestOptions::JSON=> $this->orderStatusData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$_signature,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return OrderResponse::cast(new OrderResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function getOrderCloseApiResult() : ?OrderResponse {
        $_signature = hash_hmac('sha512', json_encode($this->orderCloseData) , $this->privateKey);
        $response = $this->networkClient->post("/api/v3/cashier/close", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->orderCloseData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$_signature,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return OrderResponse::cast(new OrderResponse(), json_decode($response->getBody()->getContents(), false));
    }

    /**
     * @return OrderRequest
     */
    public final function getOrderData() : OrderRequest
    {
        return $this->orderData;
    }

    /**
     * @return OrderStatusRequest
     */
    public final function getOrderStatusData() : OrderStatusRequest
    {
        return $this->orderStatusData;
    }

    /**
     * @return OrderCloseRequest
     */
    public final function getOrderCloseData() : OrderCloseRequest
    {
        return $this->orderCloseData;
    }

}