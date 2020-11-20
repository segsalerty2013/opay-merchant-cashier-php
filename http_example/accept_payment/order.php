<?php
require_once('../init.php');

use Opay\Payload\OrderRequest;
use Opay\Utility\OpayConstants;

$_orderRequest = new OrderRequest(
    [OpayConstants::PAYMENT_METHODS_ACCOUNT, OpayConstants::PAYMENT_METHODS_QRCODE, OpayConstants::PAYMENT_METHODS_BANK_CARD, OpayConstants::PAYMENT_METHODS_BANK_ACCOUNT], $reference,
    "WOW. The best wireless earphone in history. Cannot agree more! Right!",
    [OpayConstants::PAYMENT_CHANNEL_BALANCE_PAYMENT, OpayConstants::PAYMENT_CHANNEL_BONUS_PAYMENT, OpayConstants::PAYMENT_CHANNEL_O_WEALTH_PAYMENT],
    OpayConstants::CURRENCY_NAIRA,
    "100", "+2348036952110", getUserIP(), $hostBaseUrl."/accept_payment/callback.php",
    $hostBaseUrl."/accept_payment/order_status.php", "Jerry's shop", "Apple AirPods Pro");

$merchantCashier->order($_orderRequest);

$response = $merchantCashier->getOrderApiResult();

dump("status : ". $response->getCode());
if($response->getCode() === "00000") {
    $_SESSION['orderNumberInSession'] = $response->getData()->getOrderNo();
    dump($response->getData());
} else {
    dump($response);
}

function getUserIP() {
    $ipaddress = '';
    if (isset($_SERVER['HTTP_CLIENT_IP']))
     $ipaddress = $_SERVER['HTTP_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_X_FORWARDED_FOR']))
     $ipaddress = $_SERVER['HTTP_X_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_X_FORWARDED']))
     $ipaddress = $_SERVER['HTTP_X_FORWARDED'];
    else if(isset($_SERVER['HTTP_X_CLUSTER_CLIENT_IP']))
     $ipaddress = $_SERVER['HTTP_X_CLUSTER_CLIENT_IP'];
    else if(isset($_SERVER['HTTP_FORWARDED_FOR']))
     $ipaddress = $_SERVER['HTTP_FORWARDED_FOR'];
    else if(isset($_SERVER['HTTP_FORWARDED']))
     $ipaddress = $_SERVER['HTTP_FORWARDED'];
    else if(isset($_SERVER['REMOTE_ADDR']))
     $ipaddress = $_SERVER['REMOTE_ADDR'];
    else
     $ipaddress = 'UNKNOWN';
    return $ipaddress;
}


