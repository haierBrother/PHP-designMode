<?php


abstract class Expression{
    public abstract function interpreter(array $var);
}

/**
 * 变量的解释器
 * Class VarExpression
 */
class VarExpression extends Expression{
    private $key; //key = a ,key = b, key = c

    public function VarExpression($key){
        $this->key = $key;
    }

    //var 就是a=10,b=20
    //interpreter 根据 变量名称，返回对应值
    public function interpreter(array $var)
    {
       return $var[$this->key];
    }
}

/**
 * 抽象运算符号解释器 这里，每个运算符号，都只和自己左右两个数字有关系。
 * 但左右两个数字有可能是一个解析的结果，无论何种类型，都是Expression类的实现类
 * Class SymBolExpression
 */
class SymBolExpression extends Expression{
    protected $left;
    protected $right;

    public function __construct($left,$right){
        $this->left = $left;
        $this->right = $right;
    }

    public function interpreter(array $var){
        return 0;
    }
}

/**
 * 减法解释器
 * Class SubExpression
 */
class SubExpression extends SymBolExpression{
    public function __construct(Expression $left,Exception $right){
        parent::__construct($left,$right);
    }

    //求出left和right 表达式相减后的结果
    public function interpreter(array $var){
        return $var[$this->left] - $var[$this->right];
    }
}

/**
 * 加法解释器
 * Class AddExpression
 */
class AddExpression extends SymBolExpression{
    public function __construct($left, $right)
    {
        parent::__construct($left, $right);
    }

    //处理相加
    public function interpreter(array $var)
    {
        return $var[$this->left] + $var[$this->right];
    }
}

/**
 * 计算器类
 * Class Calculator
 */
class Calculator{
    //定义表达式
    private $expression;

    //构造函数传参，并解析
    public function __construct(String $expStr){
        //安排运算先后顺序
        $stack = [];
        //表达式拆分成字符数组
        $charArr = str_split($expStr,1);
        $left = null;
        $right = null;
        foreach ($charArr as $k=>$v){
            switch ($v){
                case '+':
                    $left = array_pop();
            }
        }
    }

}

class Client{
    public static function Main(){
        $a = new SubExpression('+','-');
    }
}

