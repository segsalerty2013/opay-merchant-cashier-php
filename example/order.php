<?php

use Opay\MerchantCashier;
use Opay\Payload\OrderRequest;
use Opay\Utility\OpayConstants;

$merchantCashier = new MerchantCashier(
    "http://api.test.opaydev.com:8081",
    "qazwert12345!@#$",
    "xxxxxxxxxxxxx",
    "XXXXXXXXXXXXX");
$_orderRequest = new OrderRequest([OpayConstants::PAYMENT_CHANNEL_BALANCE_PAYMENT, OpayConstants::PAYMENT_CHANNEL_BONUS_PAYMENT], "test_201966864458800",
    "WOW. The best wireless earphone in history. Cannot agree more! Right!", [OpayConstants::PAYMENT_METHODS_ACCOUNT, OpayConstants::PAYMENT_METHODS_QRCODE], OpayConstants::CURRENCY_NAIRA,
    "10", "+2349876543210", "0:0:0:0:0:0:0:1", "https://yourdomain/callback",
    "https://yourdomain/return", "Jerry's shop", "Apple AirPods Pro");

$merchantCashier->order($_orderRequest);

$response = $merchantCashier->getOrderApiResult();

if($response->getCode() === "00000") {
    var_dump($response->getData());
}



