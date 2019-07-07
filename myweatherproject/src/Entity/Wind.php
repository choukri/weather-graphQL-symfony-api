<?php

namespace App\Entity;

class Wind
{
    protected $chill;
    protected $direction;
    protected $speed;

    public function getChill(): float
    {
        return $this->chill;
    }

    public function setChill(float $value)
    {
        $this->chill = $value;
    }

    public function getDirection(): float
    {
        return $this->direction;
    }

    public function setDirection(float $value)
    {
        $this->direction = $value;
    }

    public function getSpeed(): float
    {
        return $this->speed;
    }

    public function setSpeed(float $value)
    {
        $this->speed = $value;
    }

    public function getData(): array
    {
        return [
            'chill' => $this->getChill(),
            'direction' => $this->getDirection(),
            'speed' => $this->getSpeed()
        ];
    }

    public function setData(array $data)
    {
        $this->setChill($data['chill']);
        $this->setDirection($data['direction']);
        $this->setSpeed($data['speed']);
    }
}
