<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/4
 * Time: 19:21
 */

namespace Application\Controller\Home;
use \Framework\Tools\T as T;

class UserorderController extends \Framework\Controller{
    public function index()
    {
        require 'Application/View/Home/Userorder/Userorderlist.html';
    }

    public function save_add()
    {
        //接收参数
        $data = $_POST;
        $rs = $this->model->addOrder($data);
        //4. 显示出结果
        if ($rs) {
            T::jump('添加成功','index.php?p=Home&c=Userlist&a=Index');
        }
    }
}