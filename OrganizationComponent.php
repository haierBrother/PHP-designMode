<?php
//通过组合模式输出学校的组织结构

abstract class OrganizationComponent
{
    private $name;  //名字
    private $des;   //描述

    public function __construct($name,$des)
    {
        $this->name = $name;
        $this->name = $des;
    }

    public function setName($name){
        $this->name = $name;
    }

    public function getName(){
        return $this->name;
    }

    public function setDes($des){
        $this->des = $des;
    }

    public function getDes(){
        return $this->des;
    }

    protected function add(OrganizationComponent $organizationComponent){
        throw new Exception('无操作');
    }

    protected function remove(OrganizationComponent $organizationComponent){

    }

    protected abstract function printStr();
}

/**
 * 大学类
 * Class College
 */
class College extends OrganizationComponent{


    //数组中存放Department
    public $OrganizationComponents = [];

    //构造器
    public function __construct($name, $des)
    {
        parent::__construct($name, $des);
    }

    //重写add方法
    protected function add(OrganizationComponent $organizationComponent){
        $this->OrganizationComponents[] = $organizationComponent;
    }

    //重写remove
    protected function remove(OrganizationComponent $organizationComponent){
        $this->OrganizationComponents = array_diff($this->OrganizationComponents,[$organizationComponent]);
    }

    protected function printStr()
    {
        echo '-----------------------'.$this->getName().'----------------------'.PHP_EOL;
        // TODO: Implement printStr() method.
        foreach($this->OrganizationComponents as $v){
            $v->printStr();
        }
    }
}

class Department extends OrganizationComponent{

}
