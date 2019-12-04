<?php

namespace Opay;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Opay\Payload\OrderCloseRequest;
use Opay\Payload\OrderRequest;
use Opay\Payload\OrderStatusRequest;
use Opay\Result\OrderResponse;
use Opay\Utility\AesCipher;

class MerchantCashier
{

    private $merchantId;

    private $cryptor;
    private $orderData;
    private $orderStatusData;
    private $orderCloseData;

    private $networkClient;

    public function __construct(string $environmentBaseUrl, string $aesIv, string $aesKey, string $merchantId) {
        $this->merchantId = $merchantId;
        $this->cryptor =  new AesCipher($aesIv, $aesKey);
        $this->networkClient = new Client([
            'base_uri'=> $environmentBaseUrl
        ]);
    }

    public final function order(OrderRequest $order) {
        $this->orderData = $this->cryptor->encrypt(json_encode($order, JSON_UNESCAPED_SLASHES));
    }

    public final function orderStatus(OrderStatusRequest $orderStatus) {
        $this->orderStatusData = $this->cryptor->encrypt(json_encode($orderStatus));
    }

    public final function orderClose(OrderCloseRequest $orderClose) {
        $this->orderCloseData = $this->cryptor->encrypt(json_encode($orderClose));
    }

    public final function getOrderApiResult() : ?OrderResponse {
        $response = $this->networkClient->post("/api/cashier/order", [
            RequestOptions::JSON => [
                'data' => $this->orderData,
                'merchantId' => $this->merchantId
            ]
        ]);
        $_resp = json_decode($response->getBody()->getContents(), true);
        return new OrderResponse($this, $_resp);
    }

    public final function getOrderStatusApiResult() : ?OrderResponse {
        $response = $this->networkClient->post("/api/cashier/merchantOrderStatus", [
            RequestOptions::JSON => [
                'data' => $this->orderStatusData,
                'merchantId' => $this->merchantId
            ]
        ]);
        $_resp = json_decode($response->getBody()->getContents(), true);
        return new OrderResponse($this, $_resp);
    }

    public final function getOrderCloseApiResult() : ?OrderResponse {
        $response = $this->networkClient->post("/api/cashier/merchantCloseOrder", [
            RequestOptions::JSON => [
                'data' => $this->orderCloseData,
                'merchantId' => $this->merchantId
            ]
        ]);
        $_resp = json_decode($response->getBody()->getContents(), true);
        return new OrderResponse($this, $_resp);
    }

    /**
     * @return AES
     */
    public final function getCryptor(): AesCipher
    {
        return $this->cryptor;
    }

    /**
     * @return string
     */
    public final function getOrderData() : string
    {
        return $this->orderData;
    }

    /**
     * @return string
     */
    public final function getOrderStatusData() : string
    {
        return $this->orderStatusData;
    }

    /**
     * @return string
     */
    public final function getOrderCloseData() : string
    {
        return $this->orderCloseData;
    }

}