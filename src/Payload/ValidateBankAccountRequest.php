<?php


namespace Opay\Payload;


class ValidateBankAccountRequest implements \JsonSerializable
{
    private $countryCode;
    private $bankCode;
    private $bankAccountNo;

    public function __construct(string $countryCode, string $bankCode, string $bankAccountNumber)
    {
        $this->countryCode = $countryCode;
        $this->bankCode = $bankCode;
        $this->bankAccountNo = $bankAccountNumber;
    }

    public function jsonSerialize() : array
    {
        return [
            'countryCode'=> $this->countryCode,
            'bankCode'=> $this->bankCode,
            'bankAccountNo'=> $this->bankAccountNo
        ];
    }
}