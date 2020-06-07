<?php
//享元模式（蝇量模式）
//享元模式有内部状态和外部状态
//把对象存放在数组当中，如果需要则拿出来，避免重复创建
//享元模式提高了代码的复杂度和耦合度，但是大大降低了内存的占用，提高了效率
//网站使用者

class User{
    private $name;

    public function User($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}

//网络站点
abstract class WebSite{
    public abstract function using(User $user);   //公用的抽象方法
}

//具体的网站
class ConcreteWebSite extends WebSite {

    //共享的部分，内部状态
    private $type = ""; //网站发布的形式（类型）

    public function __construct($type)
    {
        $this->type = $type;
    }

    public function using(User $user)
    {
        echo '网站的发布形式为：' .$this->type ."在使用中...使用者是".$user->getname().PHP_EOL;
        // TODO: Implement using() method.
    }

}


//网站工厂类，根据需要返回一个网站
class WebSiteFactory{
    //集合，充当池的作用
    private $pool = [];

    //根据网站的类型，返回一个网站，如果没有就创建一个网站，并放入到池中，并返回
    public function  getWebSiteCategory($type){
        if(!$this->pool[$type]){
            //创建一个网站，并放入池中
            $this->pool[$type] = new ConcreteWebSite($type);
        }
        return $this->pool[$type];
    }

    //获取网站的分类总数（池中有多少种网络类型）
    public function getWebSiteCount(){
        return count($this->pool);
    }
}

class Client{
    public static function main(){
        //创建一个工厂类
        $factory = new WebSiteFactory();

        //客户要一个新闻形式发布的网站
        $webSite1 = $factory->getWebSiteCategory("新闻");
        $webSite1->using(new User('tom'));

        //客户要一个博客形式发布的网站
        $webSite1 = $factory->getWebSiteCategory("博客");
        $webSite1->using(new User('jack'));

        //客户要一个新闻形式发布的网站
        $webSite1 = $factory->getWebSiteCategory("博客");
        $webSite1->using(new User('tony'));

        echo '网站的分类一共有'.$factory->getWebSiteCount().'种'.PHP_EOL;
    }
}

Client::main();