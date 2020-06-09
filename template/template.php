<?php
//在模板模式（Template Pattern）中，一个抽象类公开定义了执行它的方法的方式/模板。
//它的子类可以按需要重写方法实现，但调用将以抽象类中定义的方式进行。这种类型的设计模式属于行为型模式。
//定义一个操作中的算法的骨架，而将一些步骤延迟到子类中。模板方法使得子类可以不改变一个算法的结构即可重定义该算法的某些特定步骤。

//抽象类，表示豆浆
abstract class SoyaMilk{
    //模板方法，make,可做成final方法，不让子类去覆盖
    public final function make(){
        $this->select();
        if($this->customerWantCondiments()){
            $this->addCondiments();
        } else {
            echo '不需要添加配料，跳过第二步'.PHP_EOL;
        }
        $this->soak();
        $this->beat();
    }

    //选材料
    public function select(){
        echo '第一步：选择好的新鲜黄豆'.PHP_EOL;
    }

    //添加不同的配料，抽象方法，子类具体实现
    abstract function addCondiments();

    //浸泡
    public function soak(){
        echo '第三部：黄豆和配料开始浸泡3小时'.PHP_EOL;
    }

    //打碎
    public function beat(){
        echo '第四部：黄豆和配料放入豆浆机中打碎'.PHP_EOL;
    }

    //钩子方法，决定是否需要添加配料
    public function customerWantCondiments(){
        return true;
    }
}

//花生豆浆
class PeanutSoyaMike extends SoyaMilk{

    public function addCondiments(){
        echo '第二部：加入上好的花生'.PHP_EOL;
    }
}

//红豆豆浆
class RedBeanSoyaMilk extends SoyaMilk{

    public function addCondiments(){
        echo '第二部：加入上好的红豆'.PHP_EOL;
    }
}

//纯豆浆（不需要加配料），添加钩子方法
class pureSoyaMilk extends SoyaMilk{
    public function addCondiments()
    {
        // TODO: Implement addCondiments() method.
    }

    public function customerWantCondiments(){
        return false;
    }
}

//客户端调用
class Client{
    public static function main(){
        echo '~~~~~~~~~~~~制作花生豆浆~~~~~~~~~~~~~'.PHP_EOL;
        $peanutSoayMilk = new PeanutSoyaMike();
        $peanutSoayMilk->make();

        echo '~~~~~~~~~~~~制作红豆豆浆~~~~~~~~~~~~~'.PHP_EOL;
        $redBeanSoyaMilk = new RedBeanSoyaMilk();
        $redBeanSoyaMilk->make();

        echo '~~~~~~~~~~~~制作红豆豆浆~~~~~~~~~~~~~'.PHP_EOL;
        $PureSoyaMilk = new pureSoyaMilk();
        $PureSoyaMilk->make();
    }


}

Client::main();