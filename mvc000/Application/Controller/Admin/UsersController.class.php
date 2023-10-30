<?php


namespace Application\Controller\Admin;

use \Framework\Tools\T as T;
class UsersController extends \Framework\Controller{
    public function add(){
        require "Application\View\Admin\Users\add.html";
    }

    public function save_add(){
        $data=$_POST;

        if(strlen($data['username'])<6){
            $this->err='用户名须大于六个字符';
            return false;
        }
        if(strlen($data['password'])<6){
            $this->err='密码必须于6位数';
            return false;
        }
        if($_FILES['photo']['error']==0) {
            $photo = $_FILES['photo']; //接收客户端传的文件
            $fliename=\Framework\Tools\Image::upflie($photo); //调用上传文件的工具类，实现上传文件
            if ($fliename) {
                $data['photo'] = $fliename; //上传成功
                $data['thumb_photo'] = \Framework\Tools\Image::thumb($fliename); //读取大图作为缩略图的原图，生成缩略图
            } else {
                T::jump(\Framework\Tools\Image::$err, 'index.php?p=Admin&a=index&c=Users'); //上传失败
            }
        }
        $r=$this->model->save_add($data);

        //3. 显示页面
        if($r){
            T::jump('添加成功','index.php?p=Admin&a=index&c=Users');
        }else{
            T::jump($this->model->err,'index.php?p=Admin&a=index&c=Users');
        }
    }

    public function index(){

            //接收搜索条件
            $query='1'; //定义一个空字符串，用于保存搜索条件
            if(isset($_GET['remark'])){
                $keywords=$_GET['keywords'];

                //如果有关键词，则生成模糊搜索
                if($keywords!=''){
                    $query.=" and (`remark` like '%{$keywords}%' or `realname` like
                     '%{$keywords}%')";
                }
            }
            $rows=$this->model->getSearchList($query);

            //步骤一：
            $pagesize=5; //条件一：设置每页显示多少条数据
            $page=$_GET['page']??1; //条件二：获取当前页码
            $count=count($rows); //条件三：计算得到数据总条数


            //步骤二：得到当前页应当显示哪些数据
            $rows=$this->model->getPageList($page,$pagesize,$query);

            $query_str=http_build_query($_GET); //将所有的参数拼接成http的查询字符串

            //步骤三：显示出页码
        $pageHtml=\Framework\Tools\Page::show($count,$page,$pagesize,'index.php?'.$query_str);

        $this->assign('rows',$rows);
        $this->assign('pageHtml',$pageHtml);
        require "Application\View\Admin\Users\index.html";
    }

    //做删除标记
    public function delete(){
        $user_id=$_GET['user_id'];
        $r=$this->model->truedelete($user_id);
        if($r){
            T::jump('删除成功','index.php?p=Admin&a=index&c=Users');
        }
    }
    //修改数据
    public function edit(){
        $id=$_GET['user_id'];
        $row=$this->model->getOne($id);
        require "Application\View\Admin\Users/edit.html";
    }

    public function save_edit(){
        $data=$_POST;
//  var_dump($_FILES['photo']);die;
        if($_FILES['photo']['error']==0) {
            $photo = $_FILES['photo']; //接收客户端传的文件
            $fliename=\Framework\Tools\Image::upflie($photo); //调用上传文件的工具类，实现上传文件
            if ($fliename) {

           //     var_dump($fliename);die;
                $data['photo'] = $fliename; //上传成功
                $data['thumb_photo'] = \Framework\Tools\Image::thumb($fliename); //读取大图作为缩略图的原图，生成缩略图
            } else {
                T::jump(\Framework\Tools\Image::$err, 'index.php?p=Admin&a=index&c=Users'); //上传失败
            }
        }

       // var_dump($data);die;
        $r=$this->model->save_edit($data);
        if ($r){
            T::jump('修改成功','index.php?p=Admin&a=index&c=Users');
        }
    }
}