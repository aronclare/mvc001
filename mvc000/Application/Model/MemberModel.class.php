<?php
namespace Application\Model;

class MemberModel extends \Framework\Model{
    //获取所有的管理员数据，并以二维数组方式返回
    public function getList(){
        $sql="select * from member";
        return $this->db->fetchAll($sql);
    }

    //添加管理员
    public function addMember($data){
        $username=$data['username'];
        $password=$data['password'];
        $realname=$data['realname'];
        $sex=$data['sex'];
        $telephone=$data['telephone'];
        $last_login=time();
        $photo=$data['photo'];
        $thumb_photo=$data['thumb_photo'];
        $password=md5($password);
        //构造sql语句
        $sql= "insert into member (username,password,realname,sex,telephone,last_login,`photo`,thumb_photo) values('$username','$password','$realname','$sex','$telephone','$last_login','$photo','$thumb_photo')";
        //执行sql语句
        return $this->db->query($sql);

    }

    //删除一条数据的方法
    public function delete($id){
        $sql="delete from member where member_id=$id";
        return $this->db->query($sql);
    }

    //读取一条数据的方法
    public function getOne($id){
        $sql="select * from member where member_id=$id";
        return $this->db->fetchRow($sql);
    }

    //修改一条数据的方法
    public function updateMember($data){
        $username=$data['username'];
        $password=$data['password'];
        $realname=$data['realname'];
        $sex=$data['sex'];
        $telephone=$data['telephone'];
        $photo=$data['photo'];
//        $thumb_photo=$data['photo'];
        $id=$data['member_id'];

        $sql="update member set username='$username',password='$password',realname='$realname',sex='$sex', telephone='$telephone',photo='$photo' where member_id=$id";
        return $this->db->query($sql);
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
        $sql="select * from member where {$query}";
        return $this->db->fetchAll($sql);
    }
}