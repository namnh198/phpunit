<?php

namespace Tests;

use App\Doctor;
use PHPUnit\Framework\TestCase;

class AbstractPersonTest extends TestCase
{
    public function testNameAndTitleIsReturnsString()
    {
        $doctor = new Doctor('Green');

        $this->assertEquals('Dr. Green', $doctor->getNameAndTitle());
    }

    public function testNameAndTitleIncludesValueFromGetTitle()
    {
        $mock = $this->getMockBuilder(\App\AbstractPerson::class)
            ->setConstructorArgs(['Green'])
            ->getMockForAbstractClass();

        $mock->method('getTitle')
            ->willReturn('Dr.');

        $this->assertEquals('Dr. Green', $mock->getNameAndTitle());
    }
}
