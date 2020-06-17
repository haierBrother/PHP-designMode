<?php
class Traveller{
    protected $trafficTool;
    public function __construct(Visit $trafficTool)
    {
        $this->trafficTool = $trafficTool;
    }

    public function visitTibet(){
        $this->trafficTool->go();
    }
}

$trafficTool = new Leg();
$tra = new Traveller($trafficTool);
$tra->visitTibet();