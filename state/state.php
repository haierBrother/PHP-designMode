<?php
abstract class State{

    // 扣除积分 -50
    public abstract function deductMoney();

    // 是否抽中奖品
    public abstract function raffle();

    //发放奖品
    public abstract function dispensePrize();

}

/**
 * 不能抽奖状态
 * Class NoRaffleState
 */
class NoRaffleState extends State{
    //初始化时传入活动引用，扣除积分后该表其状态
    public $activity;

    public function __construct($activity){
        $this->activity = $activity;
    }

    //当前状态可以扣除积分，扣除后，将状态设置成可抽装状态
    public function deductMoney()
    {
        echo '扣除50积分成功，您可以抽奖了'.PHP_EOL;
        $this->activity->setState($this->activity->getCanRaffleState());
    }

    //当前状态不能抽奖
    public function raffle()
    {
        echo '扣了积分才能抽奖哦！'.PHP_EOL;
    }

    //当前状态不能发放奖品
    public function dispensePrize()
    {
        echo '不能发放奖品！'.PHP_EOL;

    }
}

/**
 * 可以抽奖的状态
 */
class CanRaffleState extends State{
   public $activity;

   public function __construct($activity)
   {
       $this->activity = $activity;
   }
    //已经扣除了积分，不能再扣
    public function deductMoney()
   {
       echo '已经扣除过积分了！'.PHP_EOL;
   }

   public function raffle()
   {
       echo '正在抽奖，请稍后！'.PHP_EOL;
       $r = mt_rand(0,9);
        if($r == 0){
            echo '恭喜你，抽中奖品'.PHP_EOL;
            $this->activity->setState($this->activity->getDispenseState());
            return true;
        } else {
            echo '很遗憾，没有抽中奖品'.PHP_EOL;
            $this->activity->setState($this->activity->getNoRaffleState());
            return false;
        }
   }

    //不能发放奖品
   public function dispensePrize()
   {
       echo '没中奖，不能发放奖品！'.PHP_EOL;

   }
}

/**
 * 发放奖品的状态
 * Class DispenseState
 */
class DispenseState extends State{
    public $activity;

    public function __construct($activity)
    {
        $this->activity = $activity;
    }

    public function deductMoney()
    {
        echo '不能扣除积分'.PHP_EOL;
    }

    public function raffle()
    {
        echo '不能抽奖'.PHP_EOL;
    }

    public function dispensePrize()
    {
       if($this->activity->getCount() > 0 ){
           echo '恭喜中奖'.PHP_EOL;
           $this->activity->setState($this->activity->getNoRaffleState());
       } else {
           echo '很遗憾，奖品发送完了'.PHP_EOL;
           $this->setState($this->activity->getDispensOutState());
       }
    }
}

/**
 * 奖品发送完毕状态
 * 说明：当我们activity 改变成 DispenseOutState ,抽奖活动结束
 * Class DispenseOutState
 */
class DispenseOutState extends State{
    public $activity;

    public function __construct($activity)
    {
        $this->activity = $activity;
    }

    public function deductMoney()
    {
        echo '奖品发送完了，请下次参加'.PHP_EOL;
    }

    public function dispensePrize()
    {
        echo '奖品发送完了，请下次参加'.PHP_EOL;
    }

    public function raffle()
    {
        echo '奖品发送完了，请下次参加'.PHP_EOL;
    }
}

class RaffleActivity{
    //state 表示活动当前的状态，是变化的
    public $state = null;
    //奖品数量
    public $count = 0;

    //四个属性，表示四种状态
    public $noRaffleState ;
    public $canRaffleState;
    public $dispenseState;
    public $dispenseOutState;

    /**
     * 1.初始化当前的状态为NoRaffleState (不能抽奖状态)
     * 2.初始化奖品的数量
     * RaffleActivity constructor.
     * @param $count
     */
    public function __construct($count)
    {
        $this->count = $count;
        //四个属性，表示四种状态
        $this->noRaffleState  = new NoRaffleState($this);
        $this->canRaffleState = new CanRaffleState($this);
        $this->dispenseState  = new DispenseOutState($this);
        $this->dispenseOutState  = new DispenseOutState($this);
        $this->state = $this->getNoRaffleState();   //初始化状态
    }

    //扣分，调用当前状态 deductMoney
    public function deductMoney(){
        $this->state->deductMoney();
    }

    //抽奖
    public function raffle(){
        //如果当前状态的抽奖成功
        if($this->state->raffle()){
            //领取奖品
            $this->state->dispensePrize();
        }
    }

    public function getState(){
        return $this->state;
    }

    public function getCount(){
        $curCount = $this->count;
        $this->count--;
        return $curCount;
    }

    public function getNoRaffleState(){
        return $this->noRaffleState;
    }

    public function setNoRaffleState($noRaffleState){
        $this->noRaffleState = $noRaffleState;
    }

    /**
     * @return CanRaffleState
     */
    public function getCanRaffleState(): CanRaffleState
    {
        return $this->canRaffleState;
    }

    /**
     * @param CanRaffleState $canRaffleState
     */
    public function setCanRaffleState(CanRaffleState $canRaffleState)
    {
        $this->canRaffleState = $canRaffleState;
    }

    /**
     * @param int $count
     */
    public function setCount(int $count)
    {
        $this->count = $count;
    }

    /**
     * @param DispenseOutState $dispenseOutState
     */
    public function setDispenseOutState(DispenseOutState $dispenseOutState)
    {
        $this->dispenseOutState = $dispenseOutState;
    }

    /**
     * @param DispenseState $dispenseState
     */
    public function setDispenseState(DispenseState $dispenseState)
    {
        $this->dispenseState = $dispenseState;
    }

    /**
     * @param NoRaffleState|null $state
     */
    public function setState(State $state)
    {
        $this->state = $state;
    }

    /**
     * @return DispenseOutState
     */
    public function getDispenseState(): DispenseOutState
    {
        return $this->dispenseState;
    }

    /**
     * @return DispenseOutState
     */
    public function getDispenseOutState(): DispenseOutState
    {
        return $this->dispenseOutState;
    }
}


class Client{
    public static function main(){
        //创建活动对象，奖品有一个奖品
        $activity = new RaffleActivity(1);

        //我们连续抽30次
        for($i = 0; $i< 30; $i++){
            echo '------------第'.($i+1) .'次抽奖------------'.PHP_EOL;
            // 参加抽奖，第一步点击扣除积分
            $activity->deductMoney();

            //第二部抽奖
            $activity->raffle();

        }
    }
}


Client::main();