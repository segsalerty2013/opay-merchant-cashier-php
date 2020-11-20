<?php


namespace Opay;


use GuzzleHttp\RequestOptions;
use Opay\Payload\BanksRequest;
use Opay\Payload\BankTransferRequest;
use Opay\Payload\OpayTransferRequest;
use Opay\Payload\OrderStatusRequest;
use Opay\Payload\ValidateBankAccountRequest;
use Opay\Payload\ValidateOpayMerchantRequest;
use Opay\Payload\ValidateOpayUserRequest;
use Opay\Result\BanksResponse;
use Opay\Result\BankTransferResponse;
use Opay\Result\CountriesResponse;
use Opay\Result\OpayTransferResponse;
use Opay\Result\Response;
use Opay\Result\ValidateBankAccountResponse;
use Opay\Result\ValidateOpayMerchantResponse;
use Opay\Result\ValidateOpayUserResponse;

class MerchantTransfer extends Merchant
{
    private $banksData;
    private $bankTransferData;
    private $validateBankAccountData;
    private $orderStatusData;
    private $validateOpayMerchantData;
    private $validateOpayUserData;
    private $opayTransferData;

    /**
     * MerchantTransfer constructor.
     * @param string $environmentBaseUrl
     * @param string $pbKey
     * @param string $pvKey
     * @param string $merchantId
     * @param array|null $proxyAddress
     */
    public function __construct(string $environmentBaseUrl, string $pbKey, string $pvKey,
                                string $merchantId, ?array $proxyAddress = null) {
        parent::__construct($environmentBaseUrl, $pbKey, $pvKey, $merchantId, $proxyAddress);
    }

    public final function getCountries() : void {}

    public final function getBanks(BanksRequest $bank) : void {
        $this->banksData = $bank;
    }

    public final function validateAccount(ValidateBankAccountRequest $validateBankAccount) : void {
        $this->validateBankAccountData = $validateBankAccount;
    }

    public final function bankTransfer(BankTransferRequest $bankTransfer) : void {
        $this->bankTransferData = $bankTransfer;
    }

    public final function transferStatus(OrderStatusRequest $orderStatus) : void {
        $this->orderStatusData = $orderStatus;
    }

    public final function validateOpayMerchant(ValidateOpayMerchantRequest $validateOpayMerchant) : void {
        $this->validateOpayMerchantData = $validateOpayMerchant;
    }

    public final function validateOpayUser(ValidateOpayUserRequest $validateOpayUser) : void {
        $this->validateOpayUserData = $validateOpayUser;
    }

    public final function opayTransfer(OpayTransferRequest $opayTransfer) : void {
        $this->opayTransferData = $opayTransfer;
    }

    public final function getCountriesApiResult() : Response
    {
        $response = $this->networkClient->post("/api/v3/countries", $this->buildRequestOptions([
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$this->publicKey,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return CountriesResponse::cast(new CountriesResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function getBanksApiResult() : Response
    {
        $response = $this->networkClient->post("/api/v3/banks", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->banksData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$this->publicKey,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return BanksResponse::cast(new BanksResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function bankTransferApiResult() : Response
    {
        $requestString = json_encode($this->bankTransferData);
        $_signature = hash_hmac('sha512', $requestString, $this->privateKey);
        dump($requestString);
        $response = $this->networkClient->post("/api/v3/transfer/toBank", $this->buildRequestOptions([
            RequestOptions::JSON=> json_decode($requestString, true),
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$_signature,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return BankTransferResponse::cast(new BankTransferResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function bankTransferStatusApiResult() : Response
    {
        $_signature = hash_hmac('sha512', json_encode($this->orderStatusData), $this->privateKey);
        $response = $this->networkClient->post("/api/v3/transfer/status/toBank", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->orderStatusData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$_signature,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return BankTransferResponse::cast(new BankTransferResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function validateBankAccountApiResult() : Response
    {
        $response = $this->networkClient->post("/api/v3/verification/accountNumber/resolve", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->validateBankAccountData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$this->publicKey,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return ValidateBankAccountResponse::cast(new ValidateBankAccountResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function validateOpayMerchantApiResult() : Response
    {
        $response = $this->networkClient->post("/api/v3/info/merchant", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->validateOpayMerchantData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$this->publicKey,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return ValidateOpayMerchantResponse::cast(new ValidateOpayMerchantResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function validateOpayUserApiResult() : Response
    {
        $response = $this->networkClient->post("/api/v3/info/user", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->validateOpayUserData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$this->publicKey,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return ValidateOpayUserResponse::cast(new ValidateOpayUserResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function opayTransferApiResult() : Response
    {
        $requestString = json_encode($this->opayTransferData);
        $_signature = hash_hmac('sha512', $requestString, $this->privateKey);
        $response = $this->networkClient->post("/api/v3/transfer/toWallet", $this->buildRequestOptions([
            RequestOptions::JSON=> json_decode($requestString, true),
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$_signature,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return OpayTransferResponse::cast(new OpayTransferResponse(), json_decode($response->getBody()->getContents(), false));
    }

    public final function opayTransferStatusApiResult() : Response
    {
        $_signature = hash_hmac('sha512', json_encode($this->orderStatusData), $this->privateKey);
        $response = $this->networkClient->post("/api/v3/transfer/status/toWallet", $this->buildRequestOptions([
            RequestOptions::JSON=> $this->orderStatusData,
            RequestOptions::HEADERS=> [
                'Authorization'=> 'Bearer '.$_signature,
                'MerchantId'=> $this->merchantId
            ]
        ]));
        return OpayTransferResponse::cast(new OpayTransferResponse(), json_decode($response->getBody()->getContents(), false));
    }
}