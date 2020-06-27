<?php

//备忘录
class Memento
{
    public $id;
    public $name;
    public $liveLevel;

    public function __construct($id,$name,$liveLevel)
    {
        $this->id        = $id;
        $this->name      = $name;
        $this->liveLevel = $liveLevel;
    }

}

//备忘录管理器（使用单例模式）
class Originator{
    public  static $mementos = array();
    private static $instance;

    //单例模式确保只有一个管理器
    private function __construct()
    {

    }

    //返回单例对象
    public static function getInstance(){
        if(!self::$instance instanceof self){
            self::$instance = new self();
        }
        return self::$instance;
    }

    //存储备忘录
    public function setMemento($id,Memento $memento){
        self::$mementos[$id] = $memento;
    }

    //读取备忘录
    public function getMemento($id){
        return self::$mementos[$id];
    }
}

//创建者，玩家，可存取自生状态
class player{
    private static $i = 0;  //静态变量累加用于给

}