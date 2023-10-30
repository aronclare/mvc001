<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1
 * Time: 16:36
 */



namespace Application\Controller\Admin;
use Framework\Tools\T as T;

class GroupsController extends \Framework\Controller {
    //显示部门信息列表
    public function index(){
        $rows=$this->model->getList();
        require 'Application/View/Admin/Groups/Group_list.html';
    }
    //加载添加部门信息表单
    public function add(){
        require 'Application/View/Admin/Groups/Group_Add.html';
    }

    public function save_add(){
        //接收参数
        $data=$_POST;
        $rs=$this->model->addGroup($data);
        //4. 显示出结果
        if($rs){
            echo "<script>alert('添加成功');location.href='index.php?a=index&c=Member&p=Admin';</script>";
        }
    }


}