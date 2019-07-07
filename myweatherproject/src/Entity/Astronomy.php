<?php

namespace App\Entity;

class Astronomy
{
    protected $sunrise;
    protected $sunset;

    public function getSunrise(): string
    {
        return $this->sunrise;
    }

    public function setSunrise(string $value)
    {
        $this->sunrise = $value;
    }

    public function getSunset(): string
    {
        return $this->sunset;
    }

    public function setSunset(string $value)
    {
        $this->sunset = $value;
    }

    public function getData(): array
    {
        return [
            'sunrise' => $this->getSunrise(),
            'sunset' => $this->getSunset()
        ];
    }

    public function setData(array $data)
    {
        $this->setSunrise($data['sunrise']);
        $this->setSunset($data['sunset']);
    }
}
