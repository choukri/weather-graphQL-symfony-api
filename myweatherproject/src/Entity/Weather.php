<?php

namespace App\Entity;

class Weather
{
    protected $date_timestamp;
    protected $date_text;
    protected $condition;
    protected $astronomy;
    protected $atmosphere;
    protected $wind;
    private $day;
    private $data;

    public function __construct(array $data)
    {
        $this->data = $data;
        $this->day = $data['forecasts'][0];
        $this->astronomy = new Astronomy();
        $this->atmosphere = new Atmosphere();
        $this->condition = new Condition();
        $this->wind = new Wind();
        $this->setData();
    }

    public function getDateTimestamp(): int
    {
        return $this->date_timestamp;
    }

    public function setDateTimestamp(int $value)
    {
        $this->date_timestamp = $value;
    }

    public function getDateText(): string
    {
        return $this->date_text;
    }

    public function setDateText(string $value)
    {
        $this->date_text = date('Y-m-d',$value);
    }

    public function getCondition(): Condition
    {
        return $this->condition;
    }

    public function setCondition(array $data)
    {
        $this->condition->setData($data);
    }

    public function getAstronomy(): Astronomy
    {
        return $this->astronomy;
    }

    public function setAstronomy(array $data)
    {
        $this->astronomy->setData($data);
    }

    public function getAtmosphere(): Atmosphere
    {
        return $this->atmosphere;
    }

    public function setAtmosphere(array $data)
    {
        $this->atmosphere->setData($data);
    }

    public function getWind(): Wind
    {
        return $this->wind;
    }

    public function setWind(array $data)
    {
        $this->wind->setData($data);
    }

    public function getData(): array
    {
        return [
            'date_timestamp' => $this->getDateTimestamp(),
            'date_text' => $this->getDateText(),
            'condition' => $this->getCondition(),
            'atmosphere' => $this->getAtmosphere(),
            'astronomy' => $this->getAstronomy(),
            'wind' => $this->getWind()
        ];
    }

    public function setData()
    {
        $this->setDateTimestamp($this->day['date']);
        $this->setDateText($this->day['date']);
        $this->setCondition($this->data['current_observation']['condition']);
        $this->setAtmosphere($this->data['current_observation']['atmosphere']);
        $this->setAstronomy($this->data['current_observation']['astronomy']);
        $this->setWind($this->data['current_observation']['wind']);
    }
}
