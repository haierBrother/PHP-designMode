<?php

//飞翔类
interface FlyBehavior{
    public function fly();  //子类具体实现
}

class GoodFlyBehavior implements FlyBehavior{
    public function fly()
    {
        echo '飞翔技术高超 ~~~'.PHP_EOL;
    }
}

class NoFlyBehavior implements FlyBehavior{
    public function fly()
    {
        echo '不会飞翔 ~~~'.PHP_EOL;;
    }
}

class BadFlyBehavior implements FlyBehavior{
    public function fly()
    {
        echo '飞翔技术一般 ~~~'.PHP_EOL;;
    }
}

/**
 * 鸭子类
 * Class Dock
 */
abstract class Duck{
    //属性，策略接口
    public $flyBehavior;

    //其它属性，策略接口
    public $quackBehavior;

    public abstract function display();//显示鸭子信息

    public function fly(){
        //改进
        if($this->flyBehavior != null){
            $this->flyBehavior->fly();
        }
    }

    public function setFlyBehavior(FlyBehavior $flyBehavior){
        $this->flyBehavior = $flyBehavior;
    }

}

/**
 * 北京鸭
 * Class PekingDock
 */
class PekingDock extends Duck{

    //假如北京鸭子可以飞，但是飞行技术一般
    public function __construct()
    {
        $this->flyBehavior = new BadFlyBehavior();
    }

    public function display()
    {
        echo '北京鸭 ~~~'.PHP_EOL;
    }
}

/**
 * 玩具鸭
 * Class ToyDuck
 */
class ToyDuck extends Duck{

    public function __construct()
    {
        $this->flyBehavior = new NoFlyBehavior();
    }

    public function display(){
        echo '玩具鸭 ~~~'.PHP_EOL;
    }
}

/**
 * 野生鸭
 * Class WildDuck
 */
class WildDuck extends Duck{

    public function __construct()
    {
        $this->flyBehavior = new GoodFlyBehavior();
    }

    public function display()
    {
        echo '野鸭 ~~~'.PHP_EOL;
    }
}

class Client{
    public function main(){
        $wildDuck = new WildDuck();
        $wildDuck->display();
        $wildDuck->fly();

        $toyDuck = new ToyDuck();
        $toyDuck->display();
        $toyDuck->fly();

        $pekingDucl = new PekingDock();
        $pekingDucl->display();
        $pekingDucl->fly();
    }
}

Client::main();