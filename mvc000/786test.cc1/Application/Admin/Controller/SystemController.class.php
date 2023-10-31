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
use Think\Upload;

header("Content-Type: text/html;charset=utf-8");

/**
 * 信息管理
 */
class SystemController extends BaseController
{
    public function index(){

        //默认显示添加表单

            $systems = M('system')->where('id'==1)->find();
            $this->assign('systems',$systems);
            $this->display();

        if (IS_POST) {
            //如果用户提交数据
                $model = D("System");
                $data['refresh'] = I('Post.refresh');
                $data['black_text'] = I('Post.black_text');
//                echo "<pre>";
//                print_r($data);die;
//             $model->where('id'==1)->save($data);
//            echo $model->getLastSql();die;
                if ($model->where('id'==1)->save($data)) {
                    $this->success("系统配置成功", U('system/index'));
                } else {
                    $this->error("系统配置失败");
                }
            }
        }
}