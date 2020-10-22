<?php

namespace Tests;

use PHPUnit\Framework\TestCase;

class ProductTest extends TestCase
{
    public function testProductIdIsIntegerByDefault()
    {
        $product = new \App\Product;

        $reflection = new \ReflectionClass(\App\Product::class);
        $property = $reflection->getProperty('productId');
        $property->setAccessible(true);
        $value = $property->getValue($product);

        $this->assertIsInt($value);
    }
}
