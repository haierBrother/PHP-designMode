<?php
//抽象国家类（同事类）
abstract class Country{
    protected $mediator;

    public function __construct(UnitedNations $_mediator)
    {
        $this->mediator = $_mediator;
    }
}

//具体国家类
class USA extends Country{
    public function __construct(UnitedNations $_mediator)
    {
        parent::__construct($_mediator);
    }
    //声明
    public function Declared($message){
        $this->mediator->Declared($message,$this);
    }

    //获得消息
    public function getMessage($message){
        echo '美国获得对方消息'.$message.PHP_EOL;
    }
}

class China extends Country{
    public function __construct(UnitedNations $_mediator)
    {
        parent::__construct($_mediator);
    }

    //声明
    public function Declared($message){
        $this->mediator->Declared($message,$this);
    }

    //获得消息
    public function getMessage($message){
        echo '中国获得对方消息'.$message.PHP_EOL;
    }
}

//抽象中介者
//抽象联合国机构
abstract  class UnitedNations{
    //声明
    public abstract function Declared($message,Country $colleague);
}

class UnitedCommit extends UnitedNations{
    public $countryUsa;
    public $countryChina;

    public function Declared($message,Country $colleague){
        if($colleague == $this->countryUsa){
            $this->countryChina->GetMessage($message);
        } else {
            $this->countryUsa->getMessage($message);
        }
    }
}

//客户端调用测试代码
$UNSC = new UnitedCommit(); //中介者类
$c1 = new USA($UNSC);
$c2 = new China($UNSC);
$UNSC->countryChina = $c2;
$UNSC->countryUsa = $c1;
$c1->Declared("姚明的篮球打的就是好！");
$c2->Declared("谢谢");



