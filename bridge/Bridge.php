<?php

interface Brand{
    public function call();
    public function open();
    public function close();
}

class XiaoMi implements Brand {

    public function call(){
        echo "小米手机打电话".PHP_EOL;
    }

    public function open(){
        echo "小米手机开机".PHP_EOL;

    }

    public function close(){
        echo "小米手机关机".PHP_EOL;

    }
}

class Vivo implements Brand{
    public function call(){
        echo "Vivo手机打电话".PHP_EOL;
    }

    public function open(){
        echo "Vivo手机开机".PHP_EOL;

    }

    public function close(){
        echo "Vivo手机关机".PHP_EOL;

    }
}

abstract class Phone{
    protected $brand;
    public function __construct(Brand $brand)
    {
        $this->brand = $brand;
    }

    public abstract function call();
    public abstract function open();
    public abstract function close();

}

class UpRight extends Phone{

    public function open(){
        echo '直立手机'.PHP_EOL;
        $this->brand->open();
    }

    public function call(){
        echo '直立手机'.PHP_EOL;
        $this->brand->call();
    }


    public function close(){
        echo '直立手机'.PHP_EOL;
        $this->brand->close();
    }
}

class FoldedPhone extends Phone{

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
$phone1 = new UpRight(new XiaoMi());
$phone1->open();
$phone1->call();
$phone1->close();
echo '------------------------------'.PHP_EOL;
$phone1 = new FoldedPhone(new Vivo());
$phone1->open();
$phone1->call();
$phone1->close();