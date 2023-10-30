<?php
namespace Application\Model;

class CodeModel extends \Framework\Model
{
    //显示代金券列表
    public function getList()
    {
        $sql = "select c.code_id,c.code,u.user_id,c.money,c.status from codes c left join users u on c.user_id=u.user_id  order by code_id asc";
        return $this->db->fetchAll($sql);
    }

    //查询所有会员
    public function vip()
    {
        $sql = "select * from users";
        return $this->db->fetchAll($sql);
    }

    //保存新增代金券
    public function saveAdd($data)
    {
        $code=$data['code'];
        $user_id=$data['user_id'];
        $money=$data['money'];
        $status=$data['status'];
        $sql = "insert into codes(code,user_id,money,status)values('$code','$user_id','$money','$status')";
        return $this->db->query($sql);
    }


    //修改代金券-回显
    public function edit($id){
        return $this->db->fetchRow("select * from codes where code_id=$id");
    }
    //修改代金券-保存
    public function saveEdit($data){
        $user_id=$data['user_id'];
        $money=$data['money'];
        $status=$data['status'];
        $id=$data['code_id'];
        $sql="update codes set user_id='$user_id',money='$money',status='$status' where code_id=$id";
        return $this->db->query($sql);
    }


    //删除代金券-修改删除标识
    public function delete($id)
    {
        return $this->db->query("update codes set status=1 where code_id=$id");
    }
    //分页
    public function getPageList($page,$pagesize,$query){
        if($page==0){
            $page=1;
        }
        $start=($page-1)*$pagesize;
        $sql="select * from member where $query limit $start,$pagesize";
        return $this->db->fetchAll($sql);
    }
    //根据搜索进行分页
    public function getSearchList($query){
        $sql="select * from codes where {$query}";
        return $this->db->fetchAll($sql);
    }
}