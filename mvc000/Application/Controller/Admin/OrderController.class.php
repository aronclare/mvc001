<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/5
 * Time: 0:09
 */

namespace Application\Controller\Admin;


class OrderController extends \Framework\Controller {
    public function index(){
        $rows=$this->model->getList();
        require 'Application/View/Admin/Order/Order_list.html';
    }

    public function Reply(){
        $id=$_GET['order_id'];
        $row=$this->model->getOne($id);
        require 'Application/View/Admin/Order/Order_reply.html';
    }
}