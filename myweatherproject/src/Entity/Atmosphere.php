<?php

namespace App\Entity;

class Atmosphere
{
    protected $pressure;
    protected $visibility;
    protected $humidity;

    public function getPressure(): float
    {
        return $this->pressure;
    }

    public function setPressure(float $value)
    {
        $this->pressure = $value;
    }

    public function getVisibility(): float
    {
        return $this->visibility;
    }

    public function setVisibility(float $value)
    {
        $this->visibility = $value;
    }

    public function getHumidity(): float
    {
        return $this->humidity;
    }

    public function setHumidity(float $value)
    {
        $this->humidity = $value;
    }

    public function getData(): array
    {
        return [
            'temperature' => $this->getTemperature(),
            'pressure' => $this->getPressure(),
            'visibility' => $this->getVisibility(),
            'humidity' => $this->getHumidity()
        ];
    }

    public function setData(array $data)
    {
        $this->setPressure($data['pressure']);
        $this->setVisibility($data['visibility']);
        $this->setHumidity($data['humidity']);
    }
}
