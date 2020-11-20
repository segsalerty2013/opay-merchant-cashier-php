<?php

use Opay\Payload\BanksRequest;

require_once('../../init.php');

$getBanksRequest = new BanksRequest("NG");
$merchantTransfer->getBanks($getBanksRequest);
$response = $merchantTransfer->getBanksApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}