<?php
//抽象中介者类
abstract class Mediator{
    //将给中介者对象，加入到集合中
    public abstract function Register($colleagueName,Colleague $colleague);

    //接受消息，具体的同事对象发出
    public abstract function getMessage($stateChange,$colleagueName);

    public abstract function SendMessage();
}

//具体的中介者
class ConcreteMediator extends Mediator{
    public $colleagueMap = [];
    public $interMap = [];

    public function Register($colleagueName, Colleague $colleague)
    {
        $this->colleagueMap[$colleagueName] = $colleague;
        if ($colleague instanceof Alarm) {
            $this->interMap['Alarm'] = $colleague;
        } elseif ($colleague instanceof CoffeeMachine) {
            $this->interMap['CoffeeMachine'] = $colleague;
        } elseif ($colleague instanceof TV) {
            $this->interMap['TV'] = $colleague;
        }elseif($colleague instanceof Curtains){
            $this->interMap['Curtains'] = $colleague;
        }
    }

    //具体中介者的核心方法
    //1.根据得到消息，完成对应的任务
    //2.中介者在这个方法，协调各个具体的对象事务，完成任务
    public function getMessage($stateChange, $colleagueName)
    {
        //处理闹钟发出的消息
        if($this->colleagueMap[$colleagueName] instanceof Alarm){
            if($stateChange == 0){
                $this->interMap['CoffeeMachine']->StartCoffee();
                $this->interMap['TV']->StartTV();
            } elseif($stateChange == 1){
                $this->interMap['TV']->StopTv();
            }

        }elseif($this->colleagueMap[$colleagueName] instanceof CoffeeMachine){
            //如果是以coffeeMachine发出的消息
            $this->interMap['Curtains']->UpCurtains();
        }
    }

    public function SendMessage()
    {
        // TODO: Implement SendMessage() method.
    }
}

//抽象同事类
abstract class Colleague{
    private $mediator;
    public $name;

    public function __construct(Mediator $mediator,$name){
        $this->mediator = $mediator;
        $this->name = $name;
    }

    public function GetMediator(){
        return $this->mediator;
    }

    public abstract function SendMessage($stateChange);
}

//具体的同事类（闹钟）
class Alarm extends Colleague{

   public function __construct($mediator, $name)
   {
       parent::__construct($mediator, $name);
       $mediator->Register($name,$this);

   }

   public function SendAlarm($stateChange){
       $this->SendMessage($stateChange);
   }

   public function SendMessage($stateChange)
   {
       $this->GetMediator()->GetMessage($stateChange,$this->name);
   }
}

//具体的同事类（CoffeeMachine）
class CoffeeMachine extends Colleague{
    public function __construct($mediator, $name)
    {
        parent::__construct($mediator, $name);
        $mediator->Register($name,$this);
    }

    //发送消息
    public function SendMessage($stateChange)
    {
        $this->GetMediator()->GetMessage($stateChange,$this->name);
    }

    public function StartCoffee(){
        echo 'It\'s time to start coffee!'.PHP_EOL;
    }

    public function FinishCoffee(){
        echo 'After 5 minutes!'.PHP_EOL;
        echo 'Coffee is ok!'.PHP_EOL;
        $this->SendMessage(0);
    }
}

class TV extends Colleague{
   public function __construct($mediator, $name)
   {
       parent::__construct($mediator, $name);
       $mediator->Register($name,$this);
   }

    /**
     * @param mixed $name
     */
    public function SendMessage($stateChange)
    {
        $this->GetMediator()->getMessage($stateChange,$this->name);

    }

    public function StartTv(){
        echo "It's time to StartTV!".PHP_EOL;
    }

    public function StopTv(){
        echo 'StopTv!'.PHP_EOL;
    }
}

class Curtains extends Colleague{
    public function __construct(Mediator $mediator, $name)
    {
        parent::__construct($mediator,$name);
        $mediator->Register($name,$this);
    }

    public function SendMessage($stateChange)
    {
        $this->GetMediator()->getMessage($stateChange,$this->name);
    }

    public function UpCurtains(){
        echo 'I am holding up Curtains!';
    }
}

class Client{
    public function main(){
        //创建一个中介者对象
        $mediator = new ConcreteMediator();

        //创建Alarm对象 并且加入到 ConcreteMediator 对象的数组中
        $alarm = new ALarm($mediator,'alarm');

        //创建coffee对象 并且加入到 ConcreteMediator 对象的数组中
        $coffeeMachine = new CoffeeMachine($mediator,'coffee');

        //创建Curtains,并且加入到 ConcreteMediator 对象的数组中
        $curtains = new Curtains($mediator,"curtains");
        $tv = new TV($mediator,'TV');

        //让闹钟发出消息
        $alarm->SendAlarm(0);
        $coffeeMachine->FinishCoffee();
        $alarm->SendAlarm(1);
    }
}

Client::main();