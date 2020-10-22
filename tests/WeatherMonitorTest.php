<?php

namespace Tests;

use App\TemperatureService;
use App\WeatherMonitor;
use Mockery;
use PHPUnit\Framework\TestCase;

class WeatherMonitorTest extends TestCase
{
    public function tearDown() : void
    {
        Mockery::close();
    }

    public function testCorrectAverageIsReturned()
    {
        $service = $this->createMock(TemperatureService::class);

        $map = [
            ['12:00', 20],
            ['14:00', 26]
        ];

        $service->expects($this->exactly(2))
            ->method('getTemperature')
            ->will($this->returnValueMap($map));

        $weather = new WeatherMonitor($service);

        $this->assertEquals(23, $weather->getAverageTemperature('12:00', '14:00'));
    }

    public function testCorrectAverageIsReturnedWithMockery()
    {
        $service = Mockery::mock(TemperatureService::class);

        $service->shouldReceive('getTemperature')->with('12:00')->andReturns(20);
        $service->shouldReceive('getTemperature')->with('14:00')->andReturns(26);

        $weather = new WeatherMonitor($service);

        $this->assertEquals(23, $weather->getAverageTemperature('12:00', '14:00'));
    }
}
