<?php

namespace App\Entity;

class Condition
{
    protected $text;
    protected $temperature;

    public function getText(): string
    {
        return $this->text;
    }

    public function setText(string $value)
    {
        $this->text = $value;
    }

    public function getTemperature(): float
    {
        return $this->temperature;
    }

    public function setTemperature(float $value)
    {
        $this->temperature = $value;
    }

    public function getData(): array
    {
        return [
            'text' => $this->getText(),
            'temperature' => $this->getTemperature()
        ];
    }

    public function setData(array $data)
    {
        $this->setText($data['text']);
        $this->setTemperature($data['temperature']);
    }
}
