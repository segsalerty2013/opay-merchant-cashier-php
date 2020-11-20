<?php


namespace Opay\Payload;


class BankTransferRequest implements \JsonSerializable
{

    private $reference;
    private $amount;
    private $currency;
    private $country;
    private $receiverName;
    private $receiverBankCode;
    private $receiverBankAccountNumber;
    private $reason;

    public function __construct(string $reference, int $amount, string $currency, string $country,
                                string $receiverName, string $receiverBankCode,
                                string $receiverBankAccountNumber, string $reason)
    {
        $this->reference = $reference;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->country = $country;
        $this->receiverName = $receiverName;
        $this->receiverBankCode = $receiverBankCode;
        $this->receiverBankAccountNumber = $receiverBankAccountNumber;
        $this->reason = $reason;
    }

    public function jsonSerialize() : array
    {
        return [
            'amount'=> (string)$this->amount,
            'country'=> $this->country,
            'currency'=> $this->currency,
            'reason'=> $this->reason,
            'receiver'=> [
                'bankAccountNumber'=> $this->receiverBankAccountNumber,
                'bankCode'=> $this->receiverBankCode,
                'name'=> $this->receiverName
            ],
            'reference'=> $this->reference
        ];
    }
}