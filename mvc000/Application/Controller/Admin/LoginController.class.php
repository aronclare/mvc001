<?php
namespace Application\Controller\Admin;
use Framework\Tools\T as T;

class LoginController extends \Framework\Controller {

    public function index(){
        $pos=stripos(@$_SERVER["HTTP_REFERER"],'Login');
        if($pos===false){
            if(isset($_COOKIE['loginuser'])){
                $_POST=['username'=>$_COOKIE['loginuser'],'password'=>$_COOKIE['loginpwd']];
                $this->checklogin();
            }
        }

        require 'Application/View/Admin/Login/login.html';
    }

    public function checklogin(){
        session_start();
        $data=$_POST;

        @$data['captcha']=strtoupper($data['captcha']);
        if($data['captcha'] != $_SESSION['captcha']){
            T::jump('验证码错误','Index.php?p=Admin&a=Index&c=Login');
        }
        $r=$this->model->checklogin($data);
        if(is_array($r)){
            $_SESSION['username']=$r['username'];

            if(@$data['remember']=='1'){
                setcookie('loginuser',$data['username'],time()+365*24*3600,'/');
                setcookie('loginpwd',$data['password'],time()+365*24*3600,'/');
            }
            T::jump('登陆成功！','Index.php?p=Admin&a=Index&c=Index');
        }elseif(is_null($r)) {
            T::jump('用户名或密码有误，请检查以后再提交','Index.php?p=Admin&a=Index&c=Login');
        }else{
            T::jump($this->model->err,'Index.php?p=Admin&a=Index&c=Login');
        }
    }
    public function logout(){
        session_start();
        session_unset();
        session_destroy();
        setcookie('PHPSESSID',null,time()-1);
        setcookie('loginuser',null,time()-1,'/');
        setcookie('loginpwd',null,time()-1,'/');
        T::jump('退出成功！','Index.php?p=Admin&a=Index&c=Login');
    }

    public function captcha(){
        $bg='./public/captcha/captcha_bg'.mt_rand(1,5).'.jpg'; //1. 随机背景
        $img=imagecreatefromjpeg($bg);
        $width=imagesx($img);
        $height=imagesy($img);

        $str='123456789QWERTYUIPASDFGHJKLZXCVBNM';
        $str=str_shuffle($str);
        $code=substr($str,0,4);
        session_start();
        $_SESSION['captcha']=$code;

        $color1=imagecolorallocate($img,255,255,255);
        $color2=imagecolorallocate($img,0,0,0);
        $color='color'.mt_rand(1,2);
        imagestring($img,5,60,3,$code,$$color);
        imagerectangle($img,0,0,$width-1,$height-1,$color1);
        header('Content-Type:image/jpeg');
        imagejpeg($img);
        imagedestroy($img);
    }
}