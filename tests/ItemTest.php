<?php

namespace Tests;

use App\Item;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class ItemTest extends TestCase
{
    public function testDescriptionIsNotEmpty()
    {
        $item = new \App\Item;
        $this->assertNotEmpty($item->getDescription());
    }

    public function testIdIsInteger()
    {
        $item = new \App\ItemChild;

        $this->assertIsInt($item->getID());
    }

    public function testTokenIsString()
    {
        $item = new \App\Item;

        $reflection = new ReflectionClass(Item::class);

        $method = $reflection->getMethod('getToken');
        $method->setAccessible(true);
        $result = $method->invoke($item);

        $this->assertIsString($result);
    }

    public function testPrefixedTokenIsString()
    {
        $item = new \App\Item;

        $reflection = new ReflectionClass(Item::class);

        $method = $reflection->getMethod('getPrefixToken');
        $method->setAccessible(true);
        $result = $method->invokeArgs($item, ['example']);

        $this->assertStringStartsWith('example', $result);
    }
}
