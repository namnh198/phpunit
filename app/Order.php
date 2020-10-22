<?php

namespace App;

class Order
{
    public $quantity;

    public $unitPrice;

    public $amount = 0;

    public function __construct(int $quantity, float $unitPrice)
    {
        $this->quantity = $quantity;
        $this->unitPrice = $unitPrice;

        $this->amount = $quantity * $unitPrice;
    }

    public function process(PaymentGateway $gateway)
    {
        return $gateway->charge($this->amount);
    }
}
