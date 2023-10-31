<?php
/**
 *
 * @authors    阿连 ()
 * @wat Arlen专属上古神兽
 * @url
 *
 * ━━━━━━神兽出没━━━━━━
 * 　　   ┏┓　 ┏┓
 * 　┏━━━━┛┻━━━┛┻━━━┓
 * 　┃              ┃
 * 　┃       ━　    ┃
 * 　┃　  ┳┛ 　┗┳   ┃
 * 　┃              ┃
 * 　┃       ┻　    ┃
 * 　┃              ┃
 * 　┗━━━┓      ┏━━━┛ Code is far away from bugs with the animal protecting.
 *       ┃      ┃     神兽保佑,代码无bug。
 *       ┃      ┃
 *       ┃      ┗━━━┓
 *       ┃      　　┣┓
 *       ┃      　　┏┛
 *       ┗━┓┓┏━━┳┓┏━┛
 *     　  ┃┫┫　┃┫┫
 *     　  ┗┻┛　┗┻┛
 *
 * ━━━━━━感觉萌萌哒━━━━━━
 */
namespace Admin\Controller;
use Admin\Controller;
class NoticeController extends BaseController{

    public function index($key=""){

        if($key === ""){
            $model = M('notice');
        }else{
            $where['name'] = array('like',"%$key%");
            $where['memo'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = M('notice')->where($where);

        }

        $notice = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('sort DESC, id DESC')->select();
        $this->assign('model',getSortedCategory($notice));
        $this->display();
    }

    /**
     * 添加公告
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $model = M('notice')->select();
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Notice");
            $data = $model->create();
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($model->getError());
                exit();
            } else {
                if ($model->add($data)) {
                    $this->success("公告添加成功", U('notice/index'));
                } else {
                    $this->error("公告添加失败");
                }
            }
        }
    }





    /**
     * 更新公告信息
     * @param  [type] $id [公告ID]
     * @return [type]     [description]
     */
    public function update()
    {

        if (!IS_POST){
            $model = M('notice')->find(I('id'));
            $this->assign('model',$model);
            $this->display();
        }

        if (IS_POST) {
            //如果用户提交数据
            $model = D("Notice");
            $data = $model->create();
            if (!$data) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($model->getError());
                exit();
            } else {
                if ($model->save($data)) {
                    $this->success("公告更新成功", U('notice/index'));
                } else {
                    $this->error("公告更新失败");
                }
            }
        }
    }

    //批量保存公告排序值
    public function batchUpdateSort(){
        $ids = I('post.id');
        $sorts = I('post.sort');

        if($ids == "" || $sorts == ""){
            $this->error("请指定参数！");
        }

        if(count($ids) != count($sorts)){
            $this->error("参数不正确！");
        }

        $i = 0;
        foreach($ids as $id){
            if(!is_numeric($id) || !is_numeric($sorts[$i])){
                continue;
            }
            D('Notice')->where(array('id'=>$id))->save(array('sort'=>$sorts[$i]));
            $i++;
        }
        $this->success("批量保存排序值成功！", U('index'));
    }


    /**
     * 删除公告
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
        $id = intval($id);
        $model = D('Notice');
        //查询属于
//        $posts = D('post')->where("cate_id= %d",$id)->select();
        //验证通过
        $result = $model->delete($id);
        if($result){
            $this->success("公告删除成功", U('notice/index'));
        }else{
            $this->error("公告删除失败");
        }
    }

    public function push($id) {
        $id = intval($id);
        if (IS_GET) {
            $status = D('notice')->where("id= %d",$id)->getField('status');
            if ($status === '0') {
                $data['status'] = 1;
            } else {
                $data['status'] = 0;
            }
            $result = D('notice')->where("id= %d",$id) -> save($data);
            if ($result && $data['status'] === 1) {
                $this -> success("启用公告操作成功！", U('Notice/index'));
            } elseif ($result && $data['status'] === 0) {
                $this -> success("关闭公告操作成功！", U('Notice/index'));
            } else {
                $this->error("操作失败");
            }
        } else {
            $this->error("请指定操作参数！");
        }
    }
}