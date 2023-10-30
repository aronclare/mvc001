<?php

namespace Application\Model;

class UsersModel extends \Framework\Model{
    //显示出添加后的所有数据
    public function getList(){
        $sql="select * from member where deleted=0";
        return $this->db->fetchAll($sql);
    }
    //根据搜索条件显示
    public function getSearchList($query){
        $sql="select * from users where deleted=0 and {$query}";
        return $this->db->fetchAll($sql);
    }
    //根据页面显示数据
    public function getPageList($page,$pagesize,$query){
        if($page==0){
            $page=1;
        }
        $start=($page-1)*$pagesize;
        $sql="select * from users where deleted=0 and $query limit $start,$pagesize";
        return $this->db->fetchAll($sql);
    }
    public function save_add($data){

        $username=$data['username'];
        $sex=$data['sex'];
        $telephone=$data['telephone'];
        $remark=$data['remark'];
        $photo=$data['photo'];
        $status=$data['status'];
        $email=$data['email'];
        $password=$data['password'];
        $create_time = date('Y-m-d H:i:s',time());
        $password = md5($password);
        $sql="insert into users(username,sex,telephone,photo,remark,status,create_time,email,password)values ('$username','$sex','$telephone','$photo','$remark','$status','$create_time','$email','$password')";
        return $this->db->query($sql);
    }
    //做删除标记
    public function delete($user_id){
        $sql="update users set deleted=1 where user_id=$user_id";
        return $this->db->query($sql);
    }
    //真正删除
    public  function truedelete($user_id){
        $sql="delete from users where user_id=$user_id";
        return $this->db->query($sql);
    }
    //修改
    public function getOne($id){
        $sql="select * from users where user_id=$id";
        return $this->db->fetchRow($sql);
    }
    //保存修改
    public function save_edit($data){
        $user_id=$data['user_id'];
        $username=$data['username'];
        $sex=$data['sex'];
        $telephone=$data['telephone'];
        $image='';
        $remark=$data['remark'];
        $status = $data['status'];
        $email = $data['email'];
        $photo = $data['photo'];
        $thumb_photo = $data['thumb_photo'];
        $sql="update users set username='$username',sex='$sex',telephone='$telephone',photo='$image',remark='$remark',status='$status',email='$email',photo='$photo',thumb_photo='$thumb_photo' where user_id=$user_id";
        return $this->db->query($sql);
    }
}