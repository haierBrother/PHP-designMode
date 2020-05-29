<?php

/**
 *桥接模式
 */
interface Brand{
    public function open();
    public function call();
    public function close();
}

class XiaoMi implements Brand {
    public function open(){
        echo "小米手机开机".PHP_EOL;
    }

    public function call(){
        echo "小米手机打电话".PHP_EOL;
    }

    public function close(){
        echo "小米手机关机".PHP_EOL;
    }
}

class Vivo implements Brand{
    public function open(){
        echo "Vivo手机开机".PHP_EOL;
    }

    public function call(){
        echo "Vivo手机打电话".PHP_EOL;
    }

    public function close(){
        echo "Vivo手机关机".PHP_EOL;
    }
}

abstract class phone{
    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }
}

class upRightPhone extends Phone {

    public function __construct(Brand $brand)
    {
       parent::__construct($brand);
    }

    public function open(){
        echo '自立手机'.PHP_EOL;
        $this->brand->open();
    }

    public function call(){
        echo '自立手机'.PHP_EOL;
        $this->brand->open();
    }

    public function close(){
        echo '自立手机'.PHP_EOL;
        $this->brand->open();
    }

}

class FoldedPhone extends Phone {

    public function __construct(Brand $brand)
    {
        parent::__construct($brand);
    }

    public function open(){
        echo '折叠手机'.PHP_EOL;
        $this->brand->open();
    }

    public function call(){
        echo '折叠手机'.PHP_EOL;
        $this->brand->open();
    }

    public function close(){
        echo '折叠手机'.PHP_EOL;
        $this->brand->open();
    }

}

//客户端调用
$phone1 = new upRightPhone(new XiaoMi());
$phone1->open();
$phone1->call();
$phone1->close();

echo '~~~~~~~~~~~~~~~折叠手机~~~~~~~~~~~~~~~'.PHP_EOL;
$phone2 = new FoldedPhone(new Vivo());
$phone2->open();
$phone2->call();
$phone2->close();


