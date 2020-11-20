<?php
use Opay\Payload\OpayTransferRequest;
use Opay\Utility\OpayConstants;

require_once('../../init.php');

$opayTransferRequest = new OpayTransferRequest($reference, 100, 'NGN', 'NG',
    'Andy Lee', OpayConstants::TRANSFER_RECEIVER_TYPE_USER,
    'transfer reason message', '+2348036952110');

// to send to a merchant: *uncomment below and comment above
//$opayTransferRequest = new OpayTransferRequest($reference, 100, 'NGN', 'NG',
//    'Andy Lee', OpayConstants::TRANSFER_RECEIVER_TYPE_MERCHANT,
//    'transfer reason message', '256620111818011');

$merchantTransfer->opayTransfer($opayTransferRequest);
$response = $merchantTransfer->opayTransferApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    $_SESSION['orderNumberInSession'] = $response->getData()->getOrderNo();
    dump($response->getData());
} else {
    dump($response);
}
