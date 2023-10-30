<?php
namespace Framework;
use Framework\Tools\T as T;

class Controller{
    protected $model;

    public function __construct(){
        $className="Application\\Model\\".$GLOBALS['c']."Model";
        $this->model=new $className();

        if( $GLOBALS['p']!='Home') {
            if ($GLOBALS['c'] != 'Login') {
                $result = $this->logined();
                if (!$result) {
                    T::jump('请登陆以后再操作', 'Index.php?p=Admin&a=Index&c=Login');
                }
            }
        }
    }

    public function logined(){
        session_start();
        if( isset($_SESSION['username']) ){
            return true;
        }else{
            return false;
        }
    }

    public function alert($str,$url){
        echo "<script>alert('$str');location.href='$url';</script>";
        exit;
    }

    public function display($path=''){
        //将数组解析成变量，必须是关联数组
        extract($this->data);

        if($path){
            require VIEW_PATH.$path.'.html';
        }else{
            //如果没有传参数则根据平台控制器和方法自动加载
            require VIEW_PATH.$GLOBALS['p'].DS.$GLOBALS['c'].DS.$GLOBALS['a'].'.html';
        }
        exit;
    }

    public function assign($name,$value=''){
        if(is_array($name)){
            $this->data=array_merge($this->data,$name);
        }else{
            $this->data[$name]=$value;
        }
    }
}