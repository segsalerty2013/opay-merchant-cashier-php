<?php
require_once('./vendor/autoload.php');
require_once('init.php');

use Opay\Payload\OrderStatusRequest;

$inputJSON = file_get_contents('php://input');
$input = json_decode($inputJSON, TRUE); //convert JSON into array
$payload = $input['payload'];
file_put_contents('./log_'.date("j.n.Y").'.log', 'payload: '.json_encode($payload). "\n", FILE_APPEND);

$_orderStatusRequest = new OrderStatusRequest($payload['transactionId'], $payload['reference']);

$merchantCashier->orderStatus($_orderStatusRequest);

$response = $merchantCashier->getOrderStatusApiResult();

file_put_contents('./log_'.date("j.n.Y").'.log', 'code: '.json_encode($response->getCode()). "\n", FILE_APPEND);
file_put_contents('./log_'.date("j.n.Y").'.log', 'data: '.json_encode($response->getData()). "\n", FILE_APPEND);

// Example of data posted in callback
// {
//     "payload": {
//         "country": "NG",
//         "instrumentId": "useless",
//         "fee": "0.00",
//         "channel": "Web",
//         "reference": "test_20196699559858800",
//         "updated_at": "2019-12-13T09:36:58Z",
//         "currency": "NGN",
//         "refunded": false,
//         "instrument-id": "useless",
//         "timestamp": "2019-12-13T09:36:58Z",
//         "amount": "0.10",
//         "instrumentType": "coins",
//         "instrument_id": "useless",
//         "transactionId": "191213140104849949",
//         "token": "191213140104849949",
//         "bussinessType": "Consumption_H5",
//         "payChannel": "BalancePayment",
//         "status": "failed"
//     },
//     "sha512": "9cc847600cb7104b0a5a48976e70cf74763eb69f123a282975de1c3a751128c12d437b1f7c7d4a24bdb82b79aaa477e98e81bc66be8e8d8c3c15cdfcea730553",
//     "type": "transaction-status"
// }



