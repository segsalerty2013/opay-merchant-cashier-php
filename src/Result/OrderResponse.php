<?php

namespace Opay\Result;

use Opay\MerchantCashier;

class OrderResponse
{

    private $code;
    private $message;
    private $data;
    private $merchantCashier;

    public function __construct(MerchantCashier $merchantCashier, array $response)
    {
        $this->merchantCashier = $merchantCashier;
        if (isset($response['code'])) {
            $this->code = $response['code'];
        }
        if (isset($response['message'])) {
            $this->message = $response['message'];
        }
        if (isset($response['data'])) {
            $this->data = $response['data'];
        }
    }

    /**
     * @return mixed
     */
    public function getCode() : string
    {
        return $this->code;
    }

    /**
     * @return mixed
     */
    public function getMessage() : string
    {
        return $this->message;
    }

    /**
     * @return mixed
     */
    public function getData() : array
    {
        if (is_array($this->data)) {
            return $this->data;
        }
        if (strlen($this->data) > 10) {
            // decrypt the data
            $decrypted = $this->merchantCashier->getCryptor()->decrypt($this->data);
            return json_decode($decrypted, true);
        }
        return [];
    }

}