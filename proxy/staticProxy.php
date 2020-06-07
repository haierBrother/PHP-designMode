<?php
//静态代理模式
//被代理的对象可以是远程对象，创建开销大的对象或者需要安全控制的对象
//优点：在不需要改变目标类的功能前提下，能通过代理对象去对目标类的方法进行功能扩展
//缺点：因为代理对象需要与目标对象实现一样的接口，所以会有很多代理类，一旦接口增加方法，目标对象和代理对象都需要维护
interface ITeacherDAO{
    public function teacher();  //授课的方法
}

class TeacherDAO implements ITeacherDAO{
    public function teacher()
    {
        echo '老师授课中。。。。。。'.PHP_EOL;
        // TODO: Implement teacher() method.
    }
}


class TeacherDAOProxy implements ITeacherDAO {
    public $target;

    public function __construct(ITeacherDAO $teacher)
    {
        $this->target = $teacher;
    }

    public function teacher()
    {
        echo '代理模式开启，完成某些操作。。。。'.PHP_EOL;;
        $this->target->teacher();
        echo '代理模式关闭，完成某些操作。。。。'.PHP_EOL;
    }
}

class Client{
    public static function main(){
        //创建目标对象(被代理的对象)
        $target = new TeacherDAO();
        //创建代理对象，同时将被代理对象传递给代理对象
        $teacherDaoProxy = new TeacherDAOProxy($target);
        //通过代理对象，调用被被代理对象的方法
        //即：执行的是代理对象的方法，代理对象再去执行目标对象的方法
        $teacherDaoProxy->teacher();

    }
}

Client::main();