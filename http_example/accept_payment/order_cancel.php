<?php
require_once('../init.php');

use Opay\Payload\OrderCloseRequest;

$_orderCloseRequest = new OrderCloseRequest($orderNumberInSession, $reference);
$merchantCashier->orderClose($_orderCloseRequest);

$response = $merchantCashier->getOrderCloseApiResult();

dump("status : ". $response->getCode());
if ($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}





