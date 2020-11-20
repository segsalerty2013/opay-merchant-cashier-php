<?php

use Opay\MerchantCashier;
use Opay\Payload\OrderCloseRequest;
use Opay\Payload\OrderRequest;
use Opay\Payload\OrderStatusRequest;
use Opay\Result\OrderResponse;
use Opay\Result\Response;
use Opay\Utility\OpayConstants;
use PHPUnit\Framework\TestCase;

class MerchantCashierTest extends TestCase
{
    protected $merchantCashier;

    protected function setUp(): void
    {
        parent::setUp();
        $this->merchantCashier = new MerchantCashier(
            "http://xxxxxxxxxxxxxxx.com",
            "xxxxxxxxxxxxxxxx",
            "xxxxxxxxxxxxx",
            "XXXXXXXXXXXXX");
    }

    /**
     *
     * @return Response
     */
    public final function testOrderPayload() : Response
    {
        $_orderRequest = new OrderRequest([OpayConstants::PAYMENT_CHANNEL_BALANCE_PAYMENT, OpayConstants::PAYMENT_CHANNEL_BONUS_PAYMENT], "test_201966864458800",
            "WOW. The best wireless earphone in history. Cannot agree more! Right!", [OpayConstants::PAYMENT_METHODS_ACCOUNT, OpayConstants::PAYMENT_METHODS_QRCODE], OpayConstants::CURRENCY_NAIRA,
            "10", "+2349876543210", "0:0:0:0:0:0:0:1", "https://yourdomain/callback",
            "https://yourdomain/return", "Jerry's shop", "Apple AirPods Pro");
        $this->merchantCashier->order($_orderRequest);
        $this->assertEquals(json_encode($_orderRequest, JSON_UNESCAPED_SLASHES),
            json_encode($this->merchantCashier->getOrderData(), JSON_UNESCAPED_SLASHES));

//        $response = $this->merchantCashier->getOrderApiResult();
//        var_dump($response->getData());
        return OrderResponse::cast(new OrderResponse(), (object)[
            'code'=> '00000',
            'message'=> 'SUCCESSFUL',
            'data'=> (object)[
                'orderNo'=> '191206140094566448',//$response->getData()['orderNo'],
                'reference'=> $_orderRequest->getReference(),
                'cashierUrl'=> 'http://xxxxxxxxxxxx/api/cashierHome?data=7krxXPg4Ob%2B',
                'payAmount'=> [
                    'currency'=> "NGN",
                    'value'=> '10'
                ],
                'orderStatus'=> 'INITIAL/PENDING/SUCCESS/FAIL'
            ]
        ]);
    }

    /**
     * testOrderStatusPayload
     * @depends testOrderPayload
     * @param OrderResponse $orderResponse
     * @return void
     */
    public final function testOrderStatusPayload(OrderResponse $orderResponse) : void
    {
        $orderData = $orderResponse->getData()->toArray();
        $this->assertIsArray($orderData);
        $_orderStatusRequest = new OrderStatusRequest($orderData['orderNo'], $orderData['reference']);
        $this->merchantCashier->orderStatus($_orderStatusRequest);

        $this->assertEquals(json_encode($_orderStatusRequest), json_encode($this->merchantCashier->getOrderStatusData()));

//        $response = $this->merchantCashier->getOrderStatusApiResult();
//        var_dump($response->getData());
    }

    /**
     * testOrderClosePayload
     * @depends testOrderPayload
     * return void
     * @param OrderResponse $orderResponse
     */
    public final function testOrderClosePayload(OrderResponse $orderResponse) : void
    {
        $orderData = $orderResponse->getData()->toArray();
        $this->assertIsArray($orderData);
        $_orderCloseRequest = new OrderCloseRequest($orderData['orderNo'], $orderData['reference']);
        $this->merchantCashier->orderClose($_orderCloseRequest);

        $this->assertEquals(json_encode($_orderCloseRequest), json_encode($this->merchantCashier->getOrderCloseData()));

//        $response = $this->merchantCashier->getOrderCloseApiResult();
//        var_dump($response->getData());
    }
}