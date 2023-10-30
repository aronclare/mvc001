<?php
namespace Application\Model;

class LoginModel extends \Framework\Model{
    public function checklogin($data){
        $username=$data['username'];
        $pwd=$data['password'];
        if(strlen($username)<5){
            $this->err='用户名须大于5个字符';
            return false;
        }
        if(strlen($pwd)<6){
            $this->err='密码必须于6位数';
            return false;
        }
        $pwd=md5($pwd);
        $sql="select * from users where username='$username' and password='$pwd'";
        $last_login_time = date('Y-m-d H:i:s',time());
        $last_login_ip = $_SERVER['REMOTE_ADDR'];

        $sql_update="update users set last_login_time='$last_login_time',last_login_ip='$last_login_ip' where username='$username'";
        $this->db->query($sql_update);
        return $this->db->fetchRow($sql);
    }
}