<?php
require_once('../../init.php');

use Opay\Payload\OrderStatusRequest;

$_orderStatusRequest = new OrderStatusRequest($orderNumberInSession, $reference);

$merchantTransfer->transferStatus($_orderStatusRequest);
$response = $merchantTransfer->opayTransferStatusApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    $_SESSION['orderNumberInSession'] = $response->getData()->getOrderNo();
    dump($response->getData());
} else {
    dump($response);
}