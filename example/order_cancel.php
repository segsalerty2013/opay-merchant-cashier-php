<?php

use Opay\MerchantCashier;
use Opay\Payload\OrderCloseRequest;

$merchantCashier = new MerchantCashier(
    "http://api.test.opaydev.com:8081",
    "qazwert12345!@#$",
    "xxxxxxxxxxxxx",
    "XXXXXXXXXXXXX");

$orderNo = "94578465746574654";

$_orderCloseRequest = new OrderCloseRequest($orderNo);
$merchantCashier->orderClose($_orderCloseRequest);

$response = $merchantCashier->getOrderCloseApiResult();

if($response->getCode() === "00000") {;
    echo $response->getData();
}



