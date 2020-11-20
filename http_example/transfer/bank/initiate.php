<?php
use Opay\Payload\BankTransferRequest;

require_once('../../init.php');

$bankTransferRequest = new BankTransferRequest($reference, '100', 'NGN', 'NG',
    'Andy Lee', '050', '22222222222222', 'transfer reason message');
$merchantTransfer->bankTransfer($bankTransferRequest);
$response = $merchantTransfer->bankTransferApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    $_SESSION['orderNumberInSession'] = $response->getData()->getOrderNo();
    dump($response->getData());
} else {
    dump($response);
}
