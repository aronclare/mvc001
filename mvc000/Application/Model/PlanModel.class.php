<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/4
 * Time: 14:36
 */



namespace Application\Model;


class PlanModel extends \Framework\Model {
    //显示出添加后的所有数据
    public function getList(){
        $sql="select * from plan  where deleted=0";
        return $this->db->fetchAll($sql);
    }
    //根据搜索条件显示
    public function getSearchList($query){

        $sql="select * from plan where deleted=0 and $query";

        return $this->db->fetchAll($sql);
    }
    //根据页面显示数据
    public function getPageList($page,$pagesize){
        $start=($page-1)*$pagesize;
        $sql="select * from plan where deleted=0 limit $start,$pagesize";
        return $this->db->fetchAll($sql);
    }
    //根据搜索条件搜索并且进行分页
    public function getSearchPageList($page,$pagesize,$query){
        $start=($page-1)*$pagesize;
        $sql="select * from plan where deleted=0 and $query limit $start,$pagesize";
        return $this->db->fetchAll($sql);
    }

    public function List(){
        $sql="select * from plan where deleted=0";
        return $this->db->fetchAll($sql);
    }
    public function save_add($data){

        $name=$data['name'];
        $status=$data['status'];
        $des=$data['des'];
        $money=$data['money'];
        $add_time=time();

        $sql="insert into plan(`name`,status,des,money,add_time)values ('$name',
'$status','$des','$money','$add_time')";
        return $this->db->query($sql);
    }
    //做删除标记
    public function delete($plan_id){

        $sql="update plan set deleted=1 where plan_id=$plan_id";
        return $this->db->query($sql);
    }
    //真正删除
    public  function truedelete($plan_id){
        $sql="delete from plan where plan_id=$plan_id";
        return $this->db->query($sql);
    }
    //修改
    public function getOne($plan_id){

        $sql="select * from plan where plan_id=$plan_id";
        return $this->db->fetchRow($sql);
    }
    //保存修改
    public function save_edit($data){

        $plan_id=$data['plan_id'];
        $name=$data['name'];

        $status=$data['status'];
        $des=$data['des'];
        $money=$data['money'];
        $add_time=time();
        $sql="update plan set `name`='$name',status='$status',
des='$des',money='$money',add_time='$add_time' where plan_id='$plan_id'";
        return $this->db->query($sql);
    }


}