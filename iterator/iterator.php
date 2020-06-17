<?php


class ComputerCollegeIterator implements Iterator
{
    public $departments;    //数据（部门）
    public $position = 0;       //当前循环位置

    public function __construct($departments)
    {
        $this->departments = $departments;
    }

    /**
     * 重置迭代器
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * 校验迭代器是否有数据
     * @inheritDoc
     */
    public function valid()
    {
        return $this->position < count($this->departments);
    }

    /**
     * 获取当前内容
     * @inheritDoc
     */
    public function current()
    {
        // TODO: Implement current() method.
    }

    /**
     * 移动key到下一个
     * @inheritDoc
     */
    public function next()
    {
        return $this->position++;
        // TODO: Implement next() method.
    }

    /**
     * 迭代器位置
     * @inheritDoc
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

}

class InfoCollegeIterator implements Iterator
{
    public $departments;    //数据（部门）
    public $position = 0;   //当前循环位置

    public function __construct($departments)
    {
        $this->departments = $departments;
        $this->position = 0;
    }

    /**
     * 重置迭代器
     * @inheritDoc
     */
    public function rewind()
    {
        $this->position = 0;
    }

    /**
     * 校验迭代器是否有数据
     * @inheritDoc
     */
    public function valid()
    {
        return $this->position < count($this->departments);
    }

    /**
     * 获取当前内容
     * @inheritDoc
     */
    public function current()
    {
        // TODO: Implement current() method.
    }

    /**
     * 移动key到下一个
     * @inheritDoc
     */
    public function next()
    {
        return $this->position++;
        // TODO: Implement next() method.
    }

    /**
     * 迭代器位置
     * @inheritDoc
     */
    public function key()
    {
        // TODO: Implement key() method.
    }

}