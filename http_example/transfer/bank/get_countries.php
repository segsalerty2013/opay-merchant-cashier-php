<?php
require_once('../../init.php');

$merchantTransfer->getCountries();
$response = $merchantTransfer->getCountriesApiResult();

dump("status : ". $response->getCode());

if($response->getCode() === "00000") {
    dump($response->getData());
} else {
    dump($response);
}