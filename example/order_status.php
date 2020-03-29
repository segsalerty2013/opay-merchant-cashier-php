<?php

use Opay\MerchantCashier;
use Opay\Payload\OrderStatusRequest;

$merchantCashier = new MerchantCashier(
    "http://api.test.opaydev.com:8081",
    "qazwert12345!@#$",
    "xxxxxxxxxxxxx",
    "XXXXXXXXXXXXX");

$orderNo = "94578465746574654";
$reference = "ref-94857846574654";

$_orderStatusRequest = new OrderStatusRequest($orderNo, $reference);

$merchantCashier->orderStatus($_orderStatusRequest);

$response = $merchantCashier->getOrderStatusApiResult();

if($response->getCode() === "00000") {
    echo $response->getData();
}



