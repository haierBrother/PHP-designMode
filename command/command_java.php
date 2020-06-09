<?php
//创建命令接口
interface Command{
    //执行动作(操作)
    public function execute();
    //撤销动作（操作）
    public function undo();
}

/**
 * Class NoCommand
 *没有任何命令，即空操作:用于初始化每个按钮，当调用空按钮时，对象什么都不做
 * 其实，这也是一种设计模式，符合开闭原则
 */
class NoCommand implements Command{

    public function execute()
    {
        // TODO: Implement execute() method.
    }

    public function undo()
    {
        // TODO: Implement undo() method.
    }
}

/**
 * Class LightReceiver
 * 具体的调用类
 */
class LightReceiver{
    public function on(){
        echo '电灯打开了....'.PHP_EOL;
    }

    public function off(){
        echo "电灯关闭了....".PHP_EOL;
    }
}


/**
 * //打开灯光的命令类
 * Class LightOnCommand
 */
class LightOnCommand implements Command{
    //聚合LightReceiver

    public $light;

    //构造器
    public function __construct($light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        //调用接受者的方法
        $this->light->on();
    }

    public function undo(){
        // TODO: Implement execute() method.
        //调用接受者的方法
        $this->light->off();
    }
}

/**
 * //关闭灯光的命令类
 * Class LightOnCommand
 */
class LightOffCommand implements Command{
    //聚合LightReceiver

    public $light;

    //构造器
    public function __construct($light)
    {
        $this->light = $light;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        //调用接受者的方法
        $this->light->off();
    }

    public function undo(){
        // TODO: Implement execute() method.
        //调用接受者的方法
        $this->light->on();
    }
}


/**
 * Class LightReceiver
 * 具体的调用类
 */
class TVReceiver{
    public function no(){
        echo '打开电视机....'.PHP_EOL;
    }

    public function off(){
        echo "关闭电视机....".PHP_EOL;
    }
}

//打开电视机的命令类
class TvNoCommand implements Command {
    public $tv;
    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        $this->tv->no();
    }

   public function undo()
   {
       $this->tv->off();
       // TODO: Implement undo() method.
   }

}

//打开电视机的命令类
class TvoffCommand implements Command{
    public $tv;
    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function execute()
    {
        // TODO: Implement execute() method.
        $this->tv->off();
    }

    public function undo()
    {
        $this->tv->no();
        // TODO: Implement undo() method.
    }
}


class RemoteController {
    //开 按钮的命令数组
    public $onCommand = [];
    public $offCommand = [];

    //执行撤销的命令
    public $undoCommand;

    //构造器，完成按钮的初始化
    public function __construct()
    {

    }

    //给我们的按钮设置你需要的命令
    public function setCommand($no,$onCommand,$offCommand){
        $this->onCommand[$no] = $onCommand;
        $this->offCommand[$no] = $offCommand;
    }

    //按下开按钮
    public function onButtonWasPushed($no){
        //找到你按下的按钮，并调用对应方法
        $this->onCommand[$no]->execute();
        //记录这次的操作，用于撤销
        $this->undoCommand = $this->onCommand[$no];
    }

    //按下关按钮
    public function offButtonWasPushed($no){
        //找到你按下的按钮，并调用对应方法
        $this->offCommand[$no]->execute();
        //记录这次的操作，用于撤销
        $this->undoCommand = $this->offCommand[$no];
    }

    //按下撤销按钮
    public function undoButtonWasPushed(){
        $this->undoCommand->undo();
    }
}


class Client{
    public static function main(){
        //使用命令设计模式，完成通过遥控器，对灯的开关

        //创建电灯的接受者
        $lightReceiver = new LightReceiver();
        //创建电灯相关的开关命令
        $lightOnCommand = new LightonCommand($lightReceiver);
        $lightOffCommand = new LightOffCommand($lightReceiver);

        //需要一个遥控器
        $remoteController = new RemoteController();
        //给我们的遥控器设置命令，比如no = 0 是灯的开和关操作
        $remoteController->setCommand(0,$lightOnCommand,$lightOffCommand);

        echo "~~~~~~~~~~~~按下灯的开按钮~~~~~~~~~~".PHP_EOL;
        $remoteController->onButtonWasPushed(0);
        echo "~~~~~~~~~~~~按下灯的关按钮~~~~~~~~~~".PHP_EOL;
        $remoteController->offButtonWasPushed(0);
        echo "~~~~~~~~~~~~按下撤销操作~~~~~~~~~~~~".PHP_EOL;
        $remoteController->undoButtonWasPushed();

        echo PHP_EOL.PHP_EOL.PHP_EOL;


        //创建电视机的接受者
        $TVReceiver = new TVReceiver();
        //创建电视的开关命令
        $TvNoCommand = new TvNoCommand($TVReceiver);
        $TvOffCommand = new TvOffCommand($TVReceiver);
        $remoteController->setCommand(1,$TvNoCommand,$TvOffCommand);
        echo "~~~~~~~~~~~~按电视的开按钮~~~~~~~~~~".PHP_EOL;
        $remoteController->onButtonWasPushed(1);
        echo "~~~~~~~~~~~~按电视的关按钮~~~~~~~~~~".PHP_EOL;
        $remoteController->offButtonWasPushed(1);
        echo "~~~~~~~~~~~~按电视销操作~~~~~~~~~~~~".PHP_EOL;
        $remoteController->undoButtonWasPushed();
    }
}

client::main();