<?php
/**
 * Created by PhpStorm.
 * User: yuanzhixin
 * Date: 2018/9/4
 * Time: 15:01
 */

namespace Application\Controller\Home;
use Framework\Tools\T as T;

class AdduserController extends \Framework\Controller{
    public function index(){
        require 'Application/View/Home/Userlogin/Adduser.html';
    }

    public function save_add(){
        $data=$_POST;
        if($_FILES['photo']['error']==0) {
            $photo = $_FILES['photo'];
            $fliename=\Framework\Tools\Image::upflie($photo); //调用上传文件的工具类，实现上传文件
            if ($fliename) {
                $data['photo'] = $fliename; //上传成功
                $data['thumb_photo'] = \Framework\Tools\Image::thumb($fliename); //读取大图作为缩略图的原图，生成缩略图
            } else {
                T::jump(\Framework\Tools\Image::$err, 'index.php?p=Home&c=Adduser&a=Index'); //上传失败
            }
        }
        $r=$this->model->save_add($data);

        //3. 显示页面
        if($r){
            T::jump('注册成功，请登陆','index.php?p=Home&c=Userlogin&a=Index');
        }else{
            T::jump($this->model->err,'index.php?p=Home&c=Adduser&a=Index');
        }
    }
}