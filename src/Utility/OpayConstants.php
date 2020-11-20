<?php


namespace Opay\Utility;


class OpayConstants
{
    public const PAYMENT_METHODS_ACCOUNT = "account";
    public const PAYMENT_METHODS_QRCODE = "qrcode";
    public const PAYMENT_METHODS_BANK_CARD = "bankCard";
    public const PAYMENT_METHODS_BANK_ACCOUNT = "bankAccount";

    public const PAYMENT_CHANNEL_BALANCE_PAYMENT = "BalancePayment";
    public const PAYMENT_CHANNEL_BONUS_PAYMENT = "BonusPayment";
    public const PAYMENT_CHANNEL_O_WEALTH_PAYMENT = "OWealth";

    public const TRANSFER_RECEIVER_TYPE_USER = "USER";
    public const TRANSFER_RECEIVER_TYPE_MERCHANT = "MERCHANT";

    public const CURRENCY_NAIRA = "NGN";

    public const ORDER_EXPIRY = 10;
}