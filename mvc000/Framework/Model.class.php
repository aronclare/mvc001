<?php
namespace Framework;

//所有模型类的基础类
abstract class Model{
    protected $db;
    protected $err;

    //创建构造方法实现数据操作对象的实例化
    public function __construct(){
        $this->db=\Framework\Tools\Db::create();
    }

    //公共的读取错误信息的方法
    public function getErr(){
        return $this->err;
    }
}