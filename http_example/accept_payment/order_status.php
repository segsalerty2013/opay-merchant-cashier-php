<?php
require_once('../init.php');

use Opay\Payload\OrderStatusRequest;

$_orderStatusRequest = new OrderStatusRequest($orderNumberInSession, $reference);

$merchantCashier->orderStatus($_orderStatusRequest);

$response = $merchantCashier->getOrderStatusApiResult();

dump("status : ". $response->getCode());
if($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}
