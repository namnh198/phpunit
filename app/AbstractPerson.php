<?php

namespace App;

abstract class AbstractPerson
{
    protected $name;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    abstract protected function getTitle() : string;

    public function getNameAndTitle()
    {
        return $this->getTitle() . ' ' . $this->name;
    }
}
