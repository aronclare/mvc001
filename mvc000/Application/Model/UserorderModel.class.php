<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/4
 * Time: 19:22
 */

namespace Application\Model;


class UserOrderModel extends \Framework\Model{
    public function addOrder($data){
        $realname=$data['realname'];
        $phone=$data['phone'];
        $barber=$data['barber'];
        $amount=$data['amount'];
        $date=$data['date'];
        $content=$data['content'];
        $sql= "insert into `order`(`phone`,`realname`,`barber`,`amount`,`date`,`content`,status) values('$phone','$realname','$barber','$amount','$date','$content',0)";
        return $this->db->query($sql);
    }
}