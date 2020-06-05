<?php
//PHP一书上的工厂模式
class product{
    protected $_type;
    protected $_size;
    protected $_color;

    public function setType($type){
        $this->_type =$type;
    }

    public function setSize($size)
    {
        $this->_size = $size;
    }

    public function setColor($color)
    {
        $this->_color = $color;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->_type;
    }

    /**
     * @return mixed
     */
    public function getColor()
    {
        return $this->_color;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        return $this->_size;
    }

}

//为了创建完整的产品对象，需要将产品配置分别传递给产品类的每个方法；
$productConfigs = ['type'=>'shirt','size'=>'XL','color'=>'red'];

$product = new product();
$product->setType($productConfigs['type']);
$product->setSize($productConfigs['size']);
$product->setColor($productConfigs['color']);
//echo $product->getType();

class productBuilder{
    protected  $_product = NULL;
    protected $_configs = [];
    public function __construct($configs)
    {
        $this->_product = new product();
        $this->_configs = $configs;
    }

    public function build(){
        $this->_product->setSize($this->_configs['size']);
        $this->_product->setType($this->_configs['type']);
        $this->_product->setColor($this->_configs['color']);
    }

    public function getProduct(){
        return $this->_product;
    }
}

$builder = new productBuilder($productConfigs);
$builder->build();
$product = $builder->getProduct();

echo $product->getType().PHP_EOL;


