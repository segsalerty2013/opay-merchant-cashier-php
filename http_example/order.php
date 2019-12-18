<?php
require_once('./vendor/autoload.php');
require_once('init.php');

use Opay\Payload\OrderRequest;
use Opay\Utility\OpayConstants;

$reference = "test_20196659118854400";

$_orderRequest = new OrderRequest([OpayConstants::PAYMENT_CHANNEL_BALANCE_PAYMENT, OpayConstants::PAYMENT_CHANNEL_BONUS_PAYMENT], $reference,
    "WOW. The best wireless earphone in history. Cannot agree more! Right!", [OpayConstants::PAYMENT_METHODS_ACCOUNT, OpayConstants::PAYMENT_METHODS_QRCODE], OpayConstants::CURRENCY_NAIRA,
    "100", "+2349876543210", getUserIP(), "http://a7384c7d.ngrok.io/callback.php",
    "http://a7384c7d.ngrok.io/order_status.php", "Jerry's shop", "Apple AirPods Pro");

$merchantCashier->order($_orderRequest);

$response = $merchantCashier->getOrderApiResult();

echo "status : ". $response->getCode(). "<br/>";

if($response->getCode() === "00000") {
    var_dump($response->getData());
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
?>

