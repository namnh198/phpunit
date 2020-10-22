<?php

namespace Tests;

use App\Queue;
use PHPUnit\Framework\TestCase;

class QueueTest extends TestCase
{
    protected $queue;

    public function setUp() :void
    {
        $this->queue = new Queue;
    }

    public function tearDown() : void
    {
        unset($this->queue);
    }

    public function testNewQueueIsEmpty()
    {
        $this->assertEquals(0, $this->queue->getCount());
    }

    public function testAnItemIsAddedToTheQueue()
    {
        $this->queue->push('green');

        $this->assertEquals(1, $this->queue->getCount());
    }

    public function testAnItemIsRemovedFromTheQueue()
    {
        $this->queue->push('green');
        $result = $this->queue->pop();

        $this->assertEquals(0, $this->queue->getCount());
        $this->assertEquals('green', $result);
    }

    public function testAnItemIsRemovedFromTheFrontOfTheQueue()
    {
        $this->queue->push('green');
        $this->queue->push('blue');

        $result = $this->queue->pop();

        $this->assertEquals(1, $this->queue->getCount());
        $this->assertEquals('green', $result);
    }

    public function testMaxNumberOfItemCanBeAdded()
    {
        for($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            $this->queue->push($i);
        }

        $this->assertEquals(Queue::MAX_ITEMS, $this->queue->getCount());
    }

    public function testExceptionThrowWhenAddingMaxItemToFullQueue()
    {
        for($i = 0; $i < Queue::MAX_ITEMS; $i++) {
            $this->queue->push($i);
        }

        $this->expectException(\Exception::class);
        $this->expectExceptionMessage('Queue is full');

        $this->queue->push('item full');
    }

    public function testItemsClearedFromQueue()
    {
        $this->queue->push('Hello');

        $this->assertEquals(1, $this->queue->getCount());

        $this->queue->clear();

        $this->assertEquals(0, $this->queue->getCount());

    }
}
