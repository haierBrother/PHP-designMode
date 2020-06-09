<?php

class Tv{
    public $curr_channel = 0;

    public function turnOn(){
        echo "The televison is on .".PHP_EOL;
    }

    public function turnOff(){
        echo "The televison is off .".PHP_EOL;
    }

    public function turnChannel($channel){
        $this->curr_channel = $channel;
        echo "This TV Channel is ".$this->curr_channel.PHP_EOL;
    }
}

//执行命令接口
interface ICommand{
    function execute();
}

class CommandOn implements ICommand{
    private $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function execute()
    {
        $this->tv->turnOn();
    }
}

class CommandOff implements ICommand{
    private $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function execute()
    {
        $this->tv->turnOff();
    }
}

class CommandChannel implements ICommand{
    private $tv;
    private $channel;

    public function __construct($tv,$channel)
    {
        $this->tv = $tv;
        $this->channel = $channel;
    }

    public function execute(){
        $this->tv->turnChannel($this->channel);
    }
}

class Control{
    private $_onCommand;
    private $_offCommand;
    private $_changeChannel;

    public function __construct($on,$off,$channel)
    {
        $this->_onCommand = $on;
        $this->_offCommand = $off;
        $this->_changeChannel = $channel;
    }

    public function turnOn(){
        $this->_onCommand->execute();
    }

    public function turnOff(){
        $this->_offCommand->execute();
    }

    public function changeChannel(){
        $this->_changeChannel->execute();
    }
}

//调用客户端代码：
//命令接受者
$myTv = new Tv();
// 开机命令
$on = new CommandOn($myTv);
// 关机命令
$off = new CommandOff($myTv);

//频道切换命令
$channel = new CommandChannel($myTv,2);

// 命令控制对象　
$control = new Control($on, $off, $channel);

// 开机 　
$control->turnOn();

// 切换频道 　
$control->changeChannel();

// 关机 　
$control->turnOff();



















