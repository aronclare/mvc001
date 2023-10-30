<?php

namespace Application\Controller\Admin;

class CodeController extends \Framework\Controller
{
    //显示代金券列表
    public function index(){//act=控制器方法名
        $rows = $this->model->getList();
        //调用方法分配变量
        $this->assign('rows', $rows);
        //显示出视图模板
        require './Application/View/Admin/Codes/Code_list.html';
    }

    //显示新增界面
    public function add()
    {
        $row = $this->model->vip();
        $this->assign('row', $row);
        require './Application/View/Admin/Codes/Code_add.html';
    }
    //保存新增代金券
    public function save_add(){
        //接收数据
        $data = $_POST;
        //处理数据
        $rows = $this->model->saveAdd($data);
        //显示数据
        if ($rows){
            $this->jsmp('成功添加代金券','index.php?p=Admin&c=code&a=index');
        }else{
            self::jsmp('添加失败', 'index.php?p=Admin&c=code&a=add');
        }
    }
    //修改代金券-回显
    public function edit()
    {
        //接收数据
        $id = $_GET['code_id'];
        //处理数据
        $vip = $this->model->vip();
        $row = $this->model->edit($id);
        $this->assign('vip',$vip);
        $this->assign('row',$row);
        //显示结果
        require './Application/View/Admin/Codes/Code_edit.html';
    }
    //修改代金券-保存
    public function save_edit(){
        //接收数据
        $data=$_POST;

        //处理数据
        $row = $this->model->saveEdit($data);
        //显示结果
        if ($row){
            $this->jsmp('修改成功','index.php?p=Admin&c=code&a=index');
        }else{
            self::jsmp('修改失败', 'index.php?p=Admin&c=code&a=edit');
        }
    }
    //删除代金券-修改删除标识
    public function delete()
    {
        $id = $_GET['code_id'];
        $row = $this->model->delete($id);
        if ($row) {
            self::jsmp('已使用此代金券', 'index.php?p=Admin&c=code&a=index');
        }else{
            $this->go($this->model->geterr());
        }
    }

    public function sea(){
        //接收搜索条件
        $query='1'; //定义一个空字符串，用于保存搜索条件

        if(isset($_GET['keywords'])){
            $keywords=$_GET['keywords'];
            if($keywords!=''){
                $query.=" and (`username` like '%{$keywords}%' or `realname` like '%{$keywords}%')";
            }
        }
        $rows=$this->model->getSearchList($query);

        $pagesize=2;//规定每页显示多少条数据
        $page=$_GET['page']??1;//默认为当前第一页
        $count=count($rows);//获取总的条数
        $rows=$this->model->getPageList($page,$pagesize,$query);
        //显示出页码
        $query_str=http_build_query($_GET);
        $pageHtml=\Framework\Tools\Page::show($count,$page,$pagesize,'index.php?'.$query_str);
//        var_dump($pageHtml);
//        exit;
        //加载显示列表
        $this->assign('rows',$rows);
        $this->assign('pageHtml',$pageHtml);
        require './Application/View/Admin/Code/Code_list.html';
    }
}