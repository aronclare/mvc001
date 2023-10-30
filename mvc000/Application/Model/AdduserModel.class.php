<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/4
 * Time: 15:11
 */

namespace Application\Model;


class AdduserModel extends \Framework\Model{
    public function save_add($data){
        $username=$data['username'];
        $password=$data['password'];
        $realname=$data['realname'];
        $sex=$data['sex'];
        $telephone=$data['telephone'];

        $photo=$data['photo'];
        $password=md5($password);
        $sql="insert into `users`(`username`,`password`,`realname`,`sex`,`telephone`,`photo`)values ('$username','$password','$realname','$sex','$telephone','$photo')";
        return $this->db->query($sql);
    }
}