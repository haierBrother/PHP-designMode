<?php
abstract class Drink{
    public $des;//描述
    private $price = 0.0;   //价格

    public function setDes($des){
        $this->des = $des;
    }

    public function getDes(){
        return $this->des;
    }

    public function setPrice($price){
        $this->price = $price;
    }

    public function getPrice(){
        return $this->price;
    }

    public abstract function cost();

}

/**
 * coffee缓冲层
 * Class Coffee
 */
class Coffee extends Drink{
    public function cost()
    {
        return $this->getPrice();
    }
}

/**
 * 无因咖啡
 * Class Decof
 */
class Decof extends Coffee{
    public function __construct()
    {
        $this->setPrice(1.0);
        $this->setDes("无因咖啡 ".$this->getPrice());

    }
}

/**
 * 意大利咖啡
 * Class Espresso
 */
class Espresso extends Coffee{
    public function __construct()
    {
        $this->setPrice(6.0);
        $this->setDes("意大利咖啡 ".$this->getPrice());


    }
}

/**
 * 美式咖啡
 * Class longBlock
 */
class longBlock extends Coffee{
    public function __construct()
    {
        $this->setPrice(6.0);
        $this->setDes("美式咖啡 ".$this->getPrice());

    }
}

/**
 * 装饰者
 * Class Decorator
 */
class Decorator extends Drink{
    private  $obj;
    public function __construct(Drink $obj){
        $this->obj = $obj;
    }

    public function cost(){
        //getPrice 自己的价格
        return $this->getPrice() + $this->obj->cost();
    }

    public function getDes(){
        //
        return $this->des.' '.$this->getPrice(). ' && '.$this->obj->getDes();
    }

}


class Chocolate extends Decorator{

   public function __construct(Drink $decorator)
   {
       parent::__construct($decorator);
       $this->setDes("巧克力");
       $this->setPrice(0.3);
   }
}

class Milk extends Decorator{
    public function __construct(Drink $obj)
    {
        parent::__construct($obj);
        $this->setDes('牛奶');
        $this->setPrice(0.7);

    }
}


class CoffeeBar{
    public static function SomeCoffee(){

        //1.点一份意大利咖啡
        $order = New Espresso();
        echo '费用 = '.$order->cost().PHP_EOL;
        echo '描述 = '.$order->getDes().PHP_EOL;

        //2.加入牛奶
        $order = new Milk($order);
        echo 'order 加入一份牛奶费用 = '.$order->cost().PHP_EOL;
        echo 'order 加入一份牛奶描述 = '.$order->getDes().PHP_EOL;

        //3.加入巧克力
        $order = new Chocolate($order);
        echo 'order 加入一份巧克力费用 = '.$order->cost().PHP_EOL;
        echo 'order 加入一份巧克力描述 = '.$order->getDes().PHP_EOL;


    }
}

CoffeeBar::SomeCoffee();