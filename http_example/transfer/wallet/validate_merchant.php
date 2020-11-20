<?php
use Opay\Payload\ValidateOpayMerchantRequest;

require_once('../../init.php');

$validateOpayMerchantRequest = new ValidateOpayMerchantRequest('segsalerty@gmail.com');
$merchantTransfer->validateOpayMerchant($validateOpayMerchantRequest);
$response = $merchantTransfer->validateOpayMerchantApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}
