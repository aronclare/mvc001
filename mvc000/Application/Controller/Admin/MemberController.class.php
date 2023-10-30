<?php
//member manage
namespace Application\Controller\Admin;
use \Framework\Tools\T as T;
class MemberController extends \Framework\Controller{

    public function index(){
        //接收搜索条件
        $query='1'; //定义一个空字符串，用于保存搜索条件

        if(isset($_GET['keywords'])){
            $keywords=$_GET['keywords'];
            if($keywords!=''){
                $query.=" and (`username` like '%{$keywords}%' or `realname` like '%{$keywords}%')";
            }
        }
        $rows=$this->model->getSearchList($query);

        $pagesize=4;//规定每页显示多少条数据
        $page=$_GET['page']??1;//默认为当前第一页
        $count=count($rows);//获取总的条数
        $rows=$this->model->getPageList($page,$pagesize,$query);
        //显示出页码
        $query_str=http_build_query($_GET);
        $pageHtml=\Framework\Tools\Page::show($count,$page,$pagesize,'index.php?'.$query_str);

        //加载显示列表
        $this->assign('rows',$rows);
        $this->assign('pageHtml',$pageHtml);
        require './Application/View/Admin/Member/index.html';
    }

    //add member
    public function add(){
    //loading form
        require 'Application/View/Admin/Member/Member_add.html';
    }

    public function save_add(){
        //接收参数
        $data=$_POST;
        $photo=$_FILES['photo'];
        $fliename=\Framework\Tools\Image::upflie($photo);
        if($fliename){
            $data['photo']=$fliename;
//            $data['thumb_img']=\Framework\Tools\Image::thumb($fliename);//读取大图作为缩略图的原图，生成缩略图
        }else{
            echo  (\Framework\Tools\Image::$err); //上传失败
        }
        $rs=$this->model->addMember($data);
        //4. 显示出结果
        if($rs){
            echo "<script>alert('添加成功');location.href='index.php?a=index&c=Member&p=Admin';</script>";
        }
    }

    //删除会员
    public function delete(){
        //接收参数
        $id=$_GET['member_id'];
        $rs=$this->model->Delete($id);
        if($rs){
            echo "<script>alert('删除成功');location.href='index.php?a=index&c=Member&p=Admin';</script>";
        }
    }
    //修改会员前的查询一条数据
    public function edit(){
        $id=$_GET['member_id'];
        $row=$this->model->getOne($id);
        require 'Application/View/Admin/Member/Member_edit.html';
    }

    //修改会员以及图片
    public function save_edit(){
        $data=$_POST;
        if($_FILES['photo']['error']==0){
            $photo=$_FILES['photo'];
            $fliename=\Framework\Tools\Image::upflie($photo);
            if($fliename){
                $data['photo']=$fliename;
               $data['thumb_photo']=\Framework\Tools\Image::thumb($fliename);//读取大图作为缩略图的原图，生成缩略图
            }else{
                echo  (\Framework\Tools\Image::$err); //上传失败
            }
        }
        $rs=$this->model->updateMember($data);
        if($rs){
            echo "<script>alert('修改成功');location.href='index.php?a=index&c=Member&p=Admin';</script>";
        }
    }


}