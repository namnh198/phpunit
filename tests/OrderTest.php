<?php

namespace Tests;

use App\Order;
use Mockery;
use PHPUnit\Framework\TestCase;

class OrderTest extends TestCase
{
    public function tearDown() :void
    {
        Mockery::close();
    }

    public function testOrderIsProcessed()
    {
        $gateway = $this->getMockBuilder('App\\PaymentGateway')
            ->setMethods(['charge'])
            ->getMock();

        $gateway->expects($this->once())
            ->method('charge')
            ->with($this->equalTo(200))
            ->willReturn(true);

        $order = new Order(3, 1.99);

        $order->amount = 200;
        $this->assertTrue($order->process($gateway));
    }

    public function testOrderIsProcessedWithMockery()
    {
        $gateway = Mockery::mock('App\\PaymentGateway');

        $gateway->shouldReceive('charge')
            ->once()
            ->with(200)
            ->andReturns(true);

        $order = new Order(3, 1.99);

        $order->amount = 200;
        $this->assertTrue($order->process($gateway));
    }

    public function testOrderIsProcessedUsingAMock()
    {
        $order = new Order(3, 1.99);

        $this->assertEquals(5.97, $order->amount);

        $gatewaySpy = Mockery::spy('App\\PaymentGateway');

        $order->process($gatewaySpy);

        $gatewaySpy->shouldHaveReceived('charge')
            ->once()
            ->with(5.97);
    }
}
