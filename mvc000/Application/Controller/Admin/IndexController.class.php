<?php

namespace Application\Controller\Admin;
use Framework\Tools\T as T;

class IndexController extends \Framework\Controller{
    public function index(){
        require 'Application/View/Admin/Index/index.html';
    }

    public function nav(){
        require 'Application/View/Admin/Index/nav.html';
    }

}