<?php

namespace App;

use Exception;

class Queue
{
    const MAX_ITEMS = 5;
    protected $items = [];

    public function push($item)
    {
        if(static::MAX_ITEMS == $this->getCount()) {
            throw new Exception("Queue is full");
        }
        $this->items[] = $item;
    }

    public function pop()
    {
        return array_shift($this->items);
    }

    public function getCount()
    {
        return count($this->items);
    }

    public function clear()
    {
        $this->items = [];
    }
}
