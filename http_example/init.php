<?php

require_once('./vendor/autoload.php');

use Opay\MerchantCashier;

$merchantCashier = new MerchantCashier(
    "http://api.test.opaydev.com:8081",
    "qazwert12345!@#$",
    "fKJ8jwsj1nHNkKon",
    "256619112122000");
