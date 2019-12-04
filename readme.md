## Opay Merchant Cashier

Merchant Pre-Order API (For onboarded OPay merchants only)

### Installation:
```sh
$ composer require opay/merchant-cashier-php
```

#### Setup:
You need the following initialized
```php
use Opay\MerchantCashier;
use Opay\Payload\OrderRequest;
use Opay\Payload\OrderStatusRequest;
use Opay\Payload\OrderCloseRequest;
use Opay\Utility\OpayConstants;

$merchantCashier = new MerchantCashier("environment-endpoint-url", "AES-IV", "AES-KEY",   "your-merchant-id");
```
##### Merchant Pre-Order Call

- Request

| Parameter | Description | Sample Value |
| ------ | ------ | ------ |
| mchShortName | The short name of a Merchant. It's displayed on the payment confirmation page. | Jerry's shop |
| payMethod | Payment method 1. account (Balance payment) 2. qrcode (QRcode payment). | `OpayConstants::PAYMENT_METHODS_ACCOUNT` |
| payChannel | Payment type 1. BalancePayment (Balance account payment) 2. BonusPayment (Bonus account payment). | `OpayConstants::PAYMENT_CHANNEL_BALANCE_PAYMENT` |
| reference | Order number of merchant (unique order number from merchant platform) | `test_20191123132233` |
| userMobile | User phone number sent by merchant | `23480254xxxxx` |
| payAmount | Payment amount (payment amount of the order generated by the merchant platform, integer only, the minimum unit is kobo) | `1000` |
| userRequestIp | The IP address requested by user, need pass-through by merchant, user Anti-phishing verification. | `10.xx.xx.xxx` |
| callbackUrl | The asynchronous callback address after transaction successful. | `http://XXXXXXXXXXXXX/callback` |
| returnUrl | The address that browser go to after transaction successful | `http://XXXXXXXXXXXXXXX/return` |
| productName | Product name, utf-8 encoded | `Apple AirPods Pro` |
| productDesc | Product description, utf-8 encoded | `DESCR` |

Example

```php
$orderRequest = new OrderRequest([OpayConstants::PAYMENT_CHANNEL_BALANCE_PAYMENT, OpayConstants::PAYMENT_CHANNEL_BONUS_PAYMENT], "test_20191123132233",
    "DESCR", [OpayConstants::PAYMENT_METHODS_ACCOUNT, OpayConstants::PAYMENT_METHODS_QRCODE], OpayConstants::CURRENCY_NAIRA,
    "1000", "+23480254xxxxx", "10.xx.xx.xxx", "http://XXXXXXXXXXXXX/callback",
    "http://XXXXXXXXXXXXXXX/return", "Jerry's shop", "Apple AirPods Pro");

// then call
$merchantCashier->order($orderRequest);
$response = $merchantCashier->getOrderApiResult(); // returns OrderResponse object
// when $response->getStatus() == "00000" 
// do $response->getData() to read response Data for your app usage

```

- Response

| Parameter | Description |
| ------ | ------ |
| code | 00000 : Request successful 00001：Decrypt failed 00002：Verification of merchant's whitelisted IPs failed |
| message | response message |
| data[orderNo] | order number from OPay payment |
| data[reference] | Order number of merchant (unique order number from merchant platform) |
| data[cashierUrl] | Cashier URL address requested for user‘s browser |
| data[payAmount] | Actual payment amount, integer only, minimum unit in kobo |
| data[orderStatus] | Status like : INITIAL, PENDING, SUCCESS, or FAIL |

##### Merchant payment status query

- Request

| Parameter | Description |
| ------ | ------ |
| orderNo | order number from OPay payment |
| reference | Order number of merchant (unique order number from merchant platform) |

Example

```php
// $orderData is response from 'getOrderApiResult()'
$orderStatusRequest = new OrderStatusRequest($orderData['orderNo'], $orderData['reference']);

// then call
$merchantCashier->orderStatus($orderStatusRequest);
$result = $merchantCashier->getOrderStatusApiResult(); // returns OrderResponse object
// when $response->getStatus() == "00000" 
// do $response->getData() to read response Data for your app usage

```

- Response

| Parameter | Description |
| ------ | ------ |
| code | 00000 : Request successful 00001：Decrypt failed 00002：Verification of merchant's whitelisted IPs failed |
| message | response message |
| data[reference] | Order number of merchant (unique order number from merchant platform) |
| data[mchShortName] | Merchant's short name |
| data[userMobile] | Merchant's user Phone No. |
| data[orderNo] | order number from OPay payment |
| data[payAmount] | Actual payment amount, integer only, minimum unit in kobo |
| data[payChannel] | Payment type 1. BalancePayment (Balance account payment) 2. BonusPayment (Bonus account payment). |
| data[orderStatus] | Status like : INITIAL, PENDING, SUCCESS, or FAIL |

##### Merchant close the order

- Request

| Parameter | Description |
| ------ | ------ |
| orderNo | order number from OPay payment |

Example

```php
// $orderData is response from 'getOrderApiResult()'
$orderCloseRequest = new OrderCloseRequest($orderData['orderNo']);

// then call
$merchantCashier->orderClose($orderCloseRequest);
$response = $merchantCashier->getOrderCloseApiResult() // returns OrderResponse object
// when $response->getStatus() == "00000" 
// do $response->getData() to read response Data for your app usage

```

- Response

| Parameter | Description |
| ------ | ------ |
| code | 00000 : Request successful 00001：Decrypt failed 00002：Verification of merchant's whitelisted IPs failed |
| message | response message |
| data[reference] | Order number of merchant (unique order number from merchant platform) |
| data[orderNo] | order number from OPay payment |
| data[payAmount] | Actual payment amount, integer only, minimum unit in kobo |
| data[orderStatus] | Status like : INITIAL, PENDING, SUCCESS, or FAIL |