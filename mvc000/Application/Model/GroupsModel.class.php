<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/1
 * Time: 16:38
 */



namespace Application\Model;


class GroupsModel extends \Framework\Model {
    public function getList(){
        $sql="select * from `group`";
        return $this->db->fetchAll($sql);
    }

    public function addGroup($data){
        $name=$data['name'];
        $sql= "insert into `group` (name) values('$name')";
        return $this->db->fetchAll($sql);
    }
}