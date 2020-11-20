<?php


namespace Opay\Payload;


use Opay\Utility\OpayConstants;

class OpayTransferRequest implements \JsonSerializable
{

    private $reference;
    private $amount;
    private $currency;
    private $country;
    private $receiverName;
    private $receiverType;
    private $receiverPhoneNumber;
    private $receiverMerchantId;
    private $reason;

    public function __construct(string $reference, int $amount, string $currency, string $country,
                                string $receiverName, string $receiverType, string $reason,
                                string $receiverNumber)
    {
        $this->reference = $reference;
        $this->amount = $amount;
        $this->currency = $currency;
        $this->country = $country;
        $this->receiverName = $receiverName;
        $this->receiverType = $receiverType;
        if ($receiverType === OpayConstants::TRANSFER_RECEIVER_TYPE_MERCHANT) {
            $this->receiverMerchantId = $receiverNumber;
        } else {
            $this->receiverPhoneNumber = $receiverNumber;
        }
        $this->reason = $reason;
    }

    public function jsonSerialize() : array
    {
        if ($this->receiverType === OpayConstants::TRANSFER_RECEIVER_TYPE_MERCHANT) {
            $receiver = [
                'merchantId'=> $this->receiverMerchantId,
                'name'=> $this->receiverName,
                'type'=> $this->receiverType
            ];
        } else {
            $receiver = [
                'name'=> $this->receiverName,
                'phoneNumber'=> $this->receiverPhoneNumber,
                'type'=> $this->receiverType
            ];
        }
        return [
            'amount'=> (string)$this->amount,
            'currency'=> $this->currency,
            'reason'=> $this->reason,
            'receiver'=> $receiver,
            'reference'=> $this->reference
        ];
    }
}