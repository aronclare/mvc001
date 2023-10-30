<?php
namespace Application\Controller\Home;
use Framework\Tools\T as T;
class HomeController extends \Framework\Controller{
    public function index(){
        require 'Application/View/Home/Index/Index.html';
    }
}