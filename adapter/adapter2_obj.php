<?php
/**
 * 对象适配器
 * 根据“合成复用原则”，在系统中尽量使用关联关系（聚合）来替代继承关系
 * 对象适配器是适配器模式中常用的一种
 */

/**
 * 被适配类（插口）
 * Class Voltage220V
 */
class Voltage220V{
    //输出220V电压
    public function output220V(){
        $srcV = 220;    //输出220V电压
        echo "原电压 = ".$srcV."伏".PHP_EOL;;
        return $srcV;
    }
}

/**
 * 适配器接口
 * Interface Voltage5V
 */
interface Voltage5V{
    public function output5V();
}

/**
 * 适配器类
 * Class VoltageAdapter
 */
class VoltageAdapter implements Voltage5V{
    private $voltage220V;   //关联关系-（组合）

    public function __construct(Voltage220V $voltage220V){
        $this->voltage220V = $voltage220V;
    }

    public function output5V(){
        $dst = 0;
        if(null != $this->voltage220V){
            $src = $this->voltage220V->output220V();    //获取220v的电压
            echo '使用对象适配器，进行适配'.PHP_EOL;
            $dst = $src/44;
            echo '适配完成，输出的电压 = '.$dst.PHP_EOL;

            return $dst;
        }
    }
}

/**
 * 手机类
 * Class Phone
 */
class Phone{
    //充电
    public function charging(Voltage5V $voltage5V){
        if($voltage5V->output5V() == 5){
            echo '电压为5V,可以充电~ '.PHP_EOL;
        } else if($voltage5V->output5V() > 5){
            echo '电压大于5V,不可以充电~ '.PHP_EOL;
        }
    }
}

/**
 * 客户端开始使用
 */
echo "~~~~~~~~对象适配器模式~~~~~~~";
$phone = new Phone();
$phone->charging(new VoltageAdapter());






