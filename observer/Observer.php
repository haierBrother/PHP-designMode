<?php
class WeatherData implements \SplSubject{
    private $temperature ;
    private $pressure ;
    private $humidity ;
    private $observers = [];

    public function getPressure()
    {
        return $this->pressure;
    }

    public function getHumidity()
    {
        return $this->humidity;
    }

    public function getTemperature()
    {
        return $this->temperature;
    }

    public function setData($temperature,$pressure,$humidity){
        $this->temperature = $temperature;
        $this->pressure = $pressure;
        $this->humidity = $humidity;
        $this->dataChange();
    }

    public function dataChange(){
        $this->notify();
    }

    //添加一个观察者
    public function attach(SplObserver $observer)
    {
        $this->observers[] = $observer;
        // TODO: Implement attach() method.
    }

    //删除一个观察者
    public function detach(SplObserver $observer)
    {
        array_diff($this->observers,[$observer]);
        // TODO: Implement detach() method.
    }

    //通知所有观察者
    public function notify()
    {
        foreach($this->observers as $v){
            $v->update($this);
        }
        // TODO: Implement notify() method.
    }
}

class Baidu implements SplObserver{

    public function update(SplSubject $subject)
    {
        $this->display($subject);
    }

    public function display(SplSubject $subject){
        echo '百度网站：温度为：'.$subject->getTemperature().PHP_EOL;
        echo '百度网站：气压为：'.$subject->getHumidity().PHP_EOL;
        echo '百度网站：湿度为：'.$subject->getPressure().PHP_EOL;
    }

}

class Sina implements SplObserver{
    public function update(SplSubject $subject)
    {
        $this->display($subject);
    }

    public function display(SplSubject $subject){
        echo '新浪网站：温度为：'.$subject->getTemperature().PHP_EOL;
        echo '新浪网站：气压为：'.$subject->getHumidity().PHP_EOL;
        echo '新浪网站：湿度为：'.$subject->getPressure().PHP_EOL;
    }
}



class Client{
    public function main(){
        $baidu = new Baidu();
        $sina = new Sina();
        $WeatherData = new WeatherData();

        $WeatherData->attach($baidu);
        $WeatherData->attach($sina);

        $WeatherData->setData(10.3,70.7,100.1);
    }
}

Client::main();
