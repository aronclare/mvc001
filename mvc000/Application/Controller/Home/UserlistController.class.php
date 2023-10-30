<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/4
 * Time: 14:22
 */

namespace Application\Controller\Home;


class UserlistController extends \Framework\Controller{
    public function index(){
        require 'Application/View/Home/Userlist/Userlist.html';
    }



}