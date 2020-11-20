<?php
use Opay\Payload\ValidateBankAccountRequest;

require_once('../../init.php');

$validateBankAccountRequest = new ValidateBankAccountRequest('NG', '108', '45345343434');
$merchantTransfer->validateAccount($validateBankAccountRequest);
$response = $merchantTransfer->validateBankAccountApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}
