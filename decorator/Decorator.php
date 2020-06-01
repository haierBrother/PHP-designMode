<?php
/**
 * Created by PhpStorm.
 * User: Jiang
 * Date: 2015/5/3
 * Time: 11:11
 */

/**组件对象接口
 * Interface IComponent
 */
interface IComponent
{
    function Display();
}

/**待装饰对象
 * Class Person
 */
class Person implements IComponent
{
    private $name;

    function __construct($name)
    {
        $this->name=$name;
    }

    function Display()
    {
        echo "装扮的：{$this->name}<br/>";
    }
}

/**所有装饰器父类
 * Class Clothes
 */
class Clothes implements IComponent
{
    protected $component;

    function Decorate(IComponent $component)
    {
        $this->component=$component;
    }

    function Display()
    {
        if(!empty($this->component))
        {
            $this->component->Display();
        }
    }

}

//------------------------------具体装饰器----------------

class PiXie extends Clothes
{
    function Display()
    {
        echo "皮鞋".PHP_EOL;
        parent::Display();
    }
}

class QiuXie extends Clothes
{
    function Display()
    {
        echo "球鞋".PHP_EOL;
        parent::Display();
    }
}

class Tshirt extends Clothes
{
    function Display()
    {
        echo "T恤".PHP_EOL;
        parent::Display();
    }
}

class Waitao extends Clothes
{
    function Display()
    {
        echo "外套".PHP_EOL;
        parent::Display();
    }
}

class Client{
    public static function main(){
        $Yaoming=new Person("姚明");
        $aTai=new Person("A泰斯特");

        $pixie=new PiXie();
        $waitao=new Waitao();

        $pixie->Decorate($Yaoming);
        $waitao->Decorate($pixie);
        $waitao->Display();


        $qiuxie=new QiuXie();
        $tshirt=new Tshirt();

        $qiuxie->Decorate($aTai);
        $tshirt->Decorate($qiuxie);
        $tshirt->Display();
    }
}

Client::main();

