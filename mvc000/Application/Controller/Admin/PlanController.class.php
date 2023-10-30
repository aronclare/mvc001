<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/9/4
 * Time: 14:35
 */



namespace Application\Controller\Admin;

use Framework\Tools\T as T;
class PlanController extends \Framework\Controller {
    public function index(){
        //接收搜索条件
        $query='1'; //定义一个空字符串，用于保存搜索条件
        if(isset($_GET['keywords'])){
            $keywords=$_GET['keywords'];

            //如果有关键词，则生成模糊搜索
            if($keywords!=''){
                $query.=" and (`money` like '%{$keywords}%' or `name` like
                     '%{$keywords}%')";
            }
        }
        $rows=$this->model->getSearchList($query);

        //步骤一：
        $pagesize=3; //条件一：设置每页显示多少条数据
        $page=$_GET['page']??1; //条件二：获取当前页码
        $count=count($rows); //条件三：计算得到数据总条数

        //步骤二：得到当前页应当显示哪些数据
        $rows=$this->model->getSearchPageList($page,$pagesize,$query);

        $query_str=http_build_query($_GET); //将所有的参数拼接成http的查询字符串

        //步骤三：显示出页码
        $pageHtml=\Framework\Tools\Page::show_plus($count,$page,$pagesize,'index.php?'.$query_str);

        require "Application\View\Admin\Plan\index.html";
    }
    public function add(){
        require "Application\View\Admin\Plan\add.html";
    }
    public function save_add(){
        $data=$_POST;
        $r=$this->model->save_add($data);

        //3. 显示页面
        if($r){
            T::jump('添加成功','index.php?a=index&c=Plan');
        }else{
            T::jump($this->model->err,'index.php?a=add&c=Plan');
        }
    }
    //做删除标记
    public function delete(){
        $plan_id=$_GET['plan_id'];
        $r=$this->model->truedelete($plan_id);
        if($r){
            T::jump('做删除标记成功','index.php?p=Admin&a=index&c=Plan');
        }
    }
    //修改数据
    public function edit(){
        $plan_id=$_GET['plan_id'];
        $row=$this->model->getOne($plan_id);
        require "Application\View\Admin\Plan/edit.html";


    }

    public function save_edit(){
        $data=$_POST;
        $r=$this->model->save_edit($data);
        if ($r){

            T::jump('修改成功','index.php?p=Admin&a=index&c=Plan');
        }

    }


}