## OPay Payment v3

![](https://github.com/actions/opay-merchant-cashier-php/workflows/.github/workflows/php.yml/badge.svg)

PHP Library that wraps endpoints documented [https://documentation.opayweb.com/](https://documentation.opayweb.com/)

##### Services available for merchants includes and not limited to:
- Cashier/Checkout - Get Paid with OPay
- Bank Transfer - Send money to any Nigerian bank account(s)
- OPay wallet Transfer - Send money to OPay USER/MERCHANT seamlessly

#### Installation:
```sh
$ composer require opay/merchant-cashier-php
```

#### Setup:
You need the library initialized as follows: (example in [http_example/init.php](http_example/init.php) file)
```php
use Opay\MerchantCashier;
use Opay\MerchantTransfer;

$endpointBaseUrl = 'http://sandbox-cashierapi.opayweb.com';
$pubKey = 'OPAYPUBxxxxxxxxxxxxx.xxxxxxxxxxxxx';
$prvKey = 'OPAYPRVxxxxxxxxxxxxx.xxxxxxxxxxxxx';
$merchantId = '256620xxxxxxxxxxxxx';

$merchantCashier = new MerchantCashier("environment-endpoint-url", "Public_Key", "Private_Key",   "your-merchant-id");
$merchantTransfer = new MerchantTransfer("environment-endpoint-url", "Public_Key", "Private_Key",   "your-merchant-id");
```
#### Examples:
Access sample codes & implementations right inside the `http_example` folder

##### Accept Payment
- initiate: [http_example/accept_payment/order.php](http_example/accept_payment/order.php)
- status query: [http_example/accept_payment/order_status.php](http_example/accept_payment/order_status.php)
- cancel payment: [http_example/accept_payment/order_cancel.php](http_example/accept_payment/order_cancel.php)
- handling payment callback: [http_example/accept_payment/callback.php](http_example/accept_payment/callback.php)

##### Transfer
###### Bank
- get supported countries: [http_example/transfer/bank/get_countries.php](http_example/transfer/bank/get_countries.php)
- get supported banks: [http_example/transfer/bank/get_banks.php](http_example/transfer/bank/get_banks.php)
- validate a bank account: [http_example/transfer/bank/validate_account.php](http_example/transfer/bank/validate_account.php)
- initiate transfer: [http_example/transfer/bank/initiate.php](http_example/transfer/bank/initiate.php)
- status query: [http_example/transfer/bank/order_status.php](http_example/transfer/bank/order_status.php)

###### Opay Wallet
- validate a user/customer: [http_example/transfer/wallet/validate_user.php](http_example/transfer/wallet/validate_user.php)
- validate a merchant: [http_example/transfer/wallet/validate_merchant.php](http_example/transfer/wallet/validate_merchant.php)
- initiate transfer: [http_example/transfer/wallet/initiate.php](http_example/transfer/wallet/initiate.php)
- status query: [http_example/transfer/wallet/order_status.php](http_example/transfer/wallet/order_status.php)

##### Need Help? Feel free to open an issue.