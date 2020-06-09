<?php
abstract class Action{
    //得到男性的测评
    public abstract function getManResult(Man $man);
    //得到女性的测评
    public abstract function getWomanResult(Woman $woman);

}

class Success extends Action{
    public function getManResult(Man $man)
    {
        echo "给男歌手的评价很成功！".PHP_EOL;
    }

    public function getWomanResult(Woman $woman)
    {
        echo "给女歌手的评价很成功！".PHP_EOL;
    }
}

class Fail extends Action{
    public function getManResult(Man $man)
    {
        echo "给男歌手的评价失败！".PHP_EOL;
    }

    public function getWomanResult(Woman $woman)
    {
        echo "给女歌手的评价失败！".PHP_EOL;
    }
}

abstract class Person{
    //提供一个方法，让访问者可以访问
    public abstract function accept(Action $action);
}

//男人类
class Man extends Person{
    public function accept(Action $action)
    {
        $action->getManResult($this);
        // TODO: Implement accept() method.
    }
}

//女人类
class Woman extends Person{
    public function accept(Action $action)
    {
        $action->getWomanResult($this);
        // TODO: Implement accept() method.
    }
}

class ObjectStructure{
    public $person = [];

    //增加到list
    public function attach($p){
        $person[] = $p;
    }

    //移除
    public function detach($p)
    {
        foreach($this->person as $k=>&$v){
            if($v == $p) unset($v);
        }
    }

    //显示测评情况
    public function display(Action $action){
        foreach ($this->person as $p){
            $p->accept($action);
        }
    }
}

class Client{
    public static function main(){
        //创建访问者元素
        $objectStructure = new ObjectStructure();

        $objectStructure->attach(new Man());
        $objectStructure->attach(new Woman());

        //成功
        $success = new Success();
        $objectStructure->display($success);


    }
}

Client::main();
