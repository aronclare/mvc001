<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/4
 * Time: 10:13
 */

namespace Application\Model;


class UserloginModel extends \Framework\Model{
    public function checklogin($data){
        $username=$data['username'];
        $pwd=$data['password'];

        if(strlen($username)<2){
            $this->err='用户名必须大于两个字';
            return false;
        }
        if(strlen($pwd)<4){
            $this->err='密码必须大于4位数';
            return false;
        }
        $pwd=md5($pwd);

        $sql="select * from users where username='$username' and password='$pwd'";
        return $this->db->fetchRow($sql);
    }
}