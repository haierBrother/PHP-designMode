<?php
/**
 * 类适配器
 * 应用实例说明
 * 以生活中充电器的例子来讲解适配器，手机的充电器本身就相当于适配器，
 * 插口电压原先是220V，我们通过充电器（适配器）把电压转变为5V,然后给手机充电
 */

/**
 * 被适配类（插口）
 * Class Voltage220V
 */
class Voltage220V{

    //输出220V电压
    public function output220V(){
        $srcV = 220;
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
 * 适配类
 * Class VoltageAdapter
 */
class VoltageAdapter extends Voltage220V implements Voltage5V {
    public function output5V()
    {
        $srcV = $this->output220V();
        $dstV = $srcV/44;
        return $dstV;   //输出5V电压
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





