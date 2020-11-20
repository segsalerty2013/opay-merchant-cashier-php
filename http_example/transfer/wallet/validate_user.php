<?php
use Opay\Payload\ValidateOpayUserRequest;

require_once('../../init.php');

$validateOpayUserRequest = new ValidateOpayUserRequest('+2348036952110');
$merchantTransfer->validateOpayUser($validateOpayUserRequest);
$response = $merchantTransfer->validateOpayUserApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}
