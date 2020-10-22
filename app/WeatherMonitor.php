<?php

namespace App;

class WeatherMonitor
{
    /**
     * Temperature Service
     *
     * @var \App\TemperatureService
     */
    protected $service;

    public function __construct(TemperatureService $service)
    {
        $this->service = $service;
    }

    /**
     * Get Average Temperature
     *
     * @param string $start hh:mm
     * @param string $end hh:mm
     * @return float
     */
    public function getAverageTemperature(string $start, string $end)
    {
        $startTemp = $this->service->getTemperature($start);
        $endTemp = $this->service->getTemperature($end);

        return ($startTemp +$endTemp) / 2;
    }
}
