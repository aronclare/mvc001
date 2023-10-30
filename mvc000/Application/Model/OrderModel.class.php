<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/5
 * Time: 0:11
 */

namespace Application\Model;


class OrderModel extends \Framework\Model {
    public function getList(){
        $sql="select * from `order`";
        return $this->db->fetchAll($sql);
    }

    public function getOne($id){

        $sql="select * from `order` where order_id=$id";
        return $this->db->fetchRow($sql);
    }
}