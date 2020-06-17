<?php

class CurrentConditions{
    private $temperature;
    private $pressure;
    private $humidity;

    //更新 天气情况，是由WeatherData来调用，我使用推送模式
    public function update($temperature,$pressure,$humidity){
        $this->temperature = $temperature;
        $this->pressure    = $pressure;
        $this->humidity    = $humidity;
        $this->display();
    }

    public function display(){
        echo 'Tody mTemperature:'.$this->temperature.PHP_EOL;
        echo 'Tody mPressure:'.$this->pressure.PHP_EOL;
        echo 'Tody mHumidity:'.$this->humidity.PHP_EOL;
    }

}

class WeatherData{
    private $temperature;
    private $pressure;
    private $humidity;
    private $currentConditions;

    public function __construct(CurrentConditions $currentConditions)
    {
        $this->currentConditions = $currentConditions;
    }

    /**
     * @return CurrentConditions
     */
    public function getTemperature()
    {
        return $this->temperature;
    }

    /**
     * @return mixed
     */
    public function getHumidity()
    {
        return $this->humidity;
    }

    /**
     * @return mixed
     */
    public function getPressure()
    {
        return $this->pressure;
    }

    public function dataChange(){
        $this->currentConditions->update($this->getTemperature(),
            $this->getHumidity(),$this->getPressure()
        );
    }

    //当有数据更新时，调用setData
    public function setData($temperature,$pressure,$humidity){
        $this->temperature = $temperature;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->dataChange();
    }
}

class Client{
    public static function main(){
        $currentCondition = new CurrentConditions();
        $weatherData = new WeatherData($currentCondition);
        $weatherData->setData(33.3,150,77.7);
    }

}

Client::main();