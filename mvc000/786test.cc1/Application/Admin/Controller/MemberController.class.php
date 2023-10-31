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
/**
 * 用户管理
 */
class MemberController extends BaseController
{
    /**
     * 用户列表
     * @return [type] [description]
     */
    public function index($key="")
    {
        if($key === ""){
            $model = M('member');  
        }else{
            $where['username'] = array('like',"%$key%");
            $where['email'] = array('like',"%$key%");
            $where['_logic'] = 'or';
            $model = M('member')->where($where); 
        } 
        
        $count  = $model->where($where)->count();// 查询满足要求的总记录数
        $Page = new \Extend\Page($count,15);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
        $member = $model->limit($Page->firstRow.','.$Page->listRows)->where($where)->order('id DESC')->select();
        $this->assign('member', $member);
        $this->assign('page',$show);
        $this->display();     
    }

    /**
     * 添加用户
     */
    public function add()
    {
        //默认显示添加表单
        if (!IS_POST) {
            $this->display();
        }
        if (IS_POST) {
            //如果用户提交数据
            $model = D("Member");
//            $password = strtoupper(MD5($r['secert_code'].$password));
            if (!$model->create()) {
                // 如果创建失败 表示验证没有通过 输出错误提示信息
                $this->error($model->getError());
                exit();
            } else {
                //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
                $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
                $str = '';
                $arr_len = count($arr);
                for ($i = 0; $i < 10; $i++)
                {
                    $rand = mt_rand(0, $arr_len-1);
                    $str.=$arr[$rand];
                }
                $data = I('post.');
                $data['create_at'] = time();
                $data['type'] = 2;
                $data['secert_code'] =$str;
                $data['password'] =md5(md5(I('password')).$str);
                if ($model->add($data)) {
                    $this->success("用户添加成功", U('member/index'));
                } else {
                    $this->error("用户添加失败");
                }
            }
        }
    }
    /**
     * 更新管理员信息
     * @param  [type] $id [管理员ID]
     * @return [type]     [description]
     */
    public function update()
    {



        //默认显示添加表单
        if (!IS_POST) {
            $model = M('member')->find(I('id',"addslashes"));
            $this->assign('model',$model);
            $this->display();
        }

        if (IS_POST) {
            $model = D("Member");
            #exit;
            if (!$model->create()) {
                $this->error($model->getError());
            }else{
                //验证密码是否为空   
                $data = I('post.');
               // unset($data['password']);
                if(I('password') != ""){
                    $data['password'] = md5(I('password'));
                }
                //强制更改超级管理员用户类型
                if(C('SUPER_ADMIN_ID') == I('id')){
                    $data['type'] = 2;
                }
                //更新
                //生成一个包含 大写英文字母, 小写英文字母, 数字 的数组
                $arr = array_merge(range(0, 9), range('a', 'z'), range('A', 'Z'));
                $str = '';
                $arr_len = count($arr);
                for ($i = 0; $i < 10; $i++)
                {
                    $rand = mt_rand(0, $arr_len-1);
                    $str.=$arr[$rand];
                }
                $data['secert_code'] =$str;
                $data['password'] =md5(md5(I('password')).$str);
                if ($model->save($data)) {
                    $this->success("用户信息更新成功", U('member/index'));
                } else {
                    $this->error("未做任何修改,用户信息更新失败");
                }
            }
        }
    }
    /**
     * 删除管理员
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function delete($id)
    {
    	$id = intval($id);
    	if(C('SUPER_ADMIN_ID') == $id) $this->error("超级管理员不可禁用!");
        $model = M('member');
        //查询status字段值
        $result = $model->find($id);
        //更新字段
        $data['id']=$id;
        if($result['status'] == 1){
        	$data['status']=0;
        }
        if($result['status'] == 0){
        	$data['status']=1;
        }
        if($model->save($data)){
            $this->success("状态更新成功", U('member/index'));
        }else{
            $this->error("状态更新失败");
        }
    }
}
