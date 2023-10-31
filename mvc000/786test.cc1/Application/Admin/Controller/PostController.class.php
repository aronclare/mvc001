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

class PostController extends BaseController {









    /**

     * 信息列表

     * @return [type] [description]

     */

    public function index() {



        $cate_id = I('cate_id', 0, 'intval');

        $status = I('status');

        $starttime = I('starttime');

        $endtime = I('endtime');

        $keyword = I('keyword');

        $act = I("act");

        $andor =I('andor');



        $condition = array();



        if($cate_id > 0){

            $condition['cate_id'] = $cate_id;

        }



        if(in_array($status, array('0','1','2'))){

            $condition['status'] = $status;

        }



        if(is_date($starttime, 'Y-m-d') && is_date($endtime, 'Y-m-d')) {

            if(strtotime($starttime) > strtotime($endtime)){

                $endtime = $starttime;

            }

            $condition['addtime'] = array(array('egt',strtotime($starttime.' 0:0:0')),array('elt',strtotime($endtime.' 23:59:59')),'and');

        }elseif(is_date($starttime, 'Y-m-d') && !is_date($endtime, 'Y-m-d')) {

            $condition['addtime'] = array('egt',strtotime($starttime.' 0:0:0'));

        }elseif(!is_date($starttime, 'Y-m-d') && is_date($endtime, 'Y-m-d')) {

            $condition['addtime'] = array('elt',strtotime($endtime.' 0:0:0'));

        }



        if(!empty($keyword)){

            if($andor==0){

                $condition['username'] = array('like', "%" . $keyword . "%");

            }elseif($andor==1){

                $condition['memo'] = array('like', "%" . $keyword . "%");

            }elseif($andor==2){

                $condition['username'] = array('like', "%" . $keyword . "%");

                $condition['memo'] = array('like', "%" . $keyword . "%");

                $condition['ip'] = array('like', "%" . $keyword . "%");

                $condition['edit_user'] = array('like', "%" . $keyword . "%");

                $condition['_logic'] = 'or';

            }

        }



        if($act != "export") $act = "search";



        //项目名称列表

        $cates = D('Category')->field('id,name')->select();

        $categorys_1 = array();

        foreach($cates as $r){

            $categorys_1[$r['id']] = $r['name'];

        }



        $statusAry = array('0'=>'未审核', '1'=>'审核通过', '2'=>'审核未通过');



        //导出数据

        if($act == "export") {

            $infos = D("Post")->where($condition)->order('status ASC, id DESC')->select();

           /*  $csv = "编号,会员账号,项目,彩金,审核情况,申请时间,审核时间,备注,周有效投注,连拿时间,会员姓名,日有效投注,注单时间,亏损金额,联系QQ,单笔存款金额,连赢时间,申请关数,申请金额,流水倍数,游戏项目,联系邮箱,申请牌型,连赢局数,盈利额度,申请类型,注册彩金,上级ID,会员ID,注单号后7位,下级ID,被推荐人微信号,新手机号后4位,邀请好友\n"; */
			
			
			 $csv = "编号,会员账号,项目,彩金,审核情况,申请时间,审核时间,备注,会员IP\n";

           /*  foreach($infos as $r){

                $csv .= $r['id'].",".str_replace(',',"，",$r['username']).",".$categorys_1[$r["cate_id"]].",".str_replace(',',"，",$r['handsel']).",".$statusAry[$r["status"]].",".date("Y-m-d H:i:s", $r['addtime']).",".date("Y-m-d H:i:s", $r['audit_time']).",".str_replace(',',"，", $r["memo"]).",".str_replace(',',"，", $r["effective_betting"]).",".str_replace(',',"，", $r["application_date"]).",".str_replace(',',"，", $r["member_name"]).",".str_replace(',',"，", $r["number_participants"]).",".str_replace(',',"，", $r["can_win_prizes"]).",".str_replace(',',"，", $r["losses"]).",".str_replace(',',"，", $r["contact_qq"]).",".str_replace(',',"，", $r["note_the_single_amount"]).",".str_replace(',',"，", $r["apply_for_days"]).",".str_replace(',',"，", $r["apply_for_customs_number"]).",".str_replace(',',"，", $r["winnerPaid"]).",".str_replace(',',"，", $r["multiple_water"]).",".str_replace(',',"，", $r["game_project"]).",".str_replace(',',"，", $r["contact_via_mail"]).",".str_replace(',',"，", $r["note_the_single_code"]).",".str_replace(',',"，", $r["quantity_completion"]).",".str_replace(',',"，", $r["profit_quota"]).",".str_replace(',',"，", $r["application_type"]).",".str_replace(',',"，", $r["set_bonus"]).",".str_replace(',',"，", $r["old_username"]).",".str_replace(',',"，", $r["old_name"]).",".str_replace(',',"，", $r["old_phone"]).",".str_replace(',',"，", $r["new_username"]).",".str_replace(',',"，", $r["new_name"]).",".str_replace(',',"，", $r["new_phone"]).",".str_replace(',',"，", $r["friends"])."\n";

            }
			 */
			 
			foreach($infos as $r){

                $csv .= $r['id'].",".str_replace(',',"，",$r['username']).",".$categorys_1[$r["cate_id"]].",".str_replace(',',"，",$r['handsel']).",".$statusAry[$r["status"]].",".date("Y-m-d H:i:s", $r['addtime']).",".date("Y-m-d H:i:s", $r['audit_time']).",".str_replace(',',"，", $r["memo"]).",".$r["ip"]."\n";

            }

            //输出csv

            $filename = '优惠申请_'.date('YmdHis').'.csv';

			

			ob_end_clean();
			
            //header("Content-type:text/csv");
			
			
            header("Content-Disposition:attachment;filename=".$filename);

            header('Cache-Control:must-revalidate,post-check=0,pre-check=0');

            header('Expires:0');

            header('Pragma:public');

            echo $csv;

            exit();

        }



        $model = D('Post')->where($condition);









        $count = $model->where($condition)->count(); // 查询满足要求的总记录数

        $Page = new \Extend\Page($count, 30); // 实例化分页类 传入总记录数和每页显示的记录数(25)

        $pagelist = $Page->show(); // 分页显示输出

        $infos = $model->limit($Page->firstRow . ',' . $Page->listRows)->where($condition)->order('status ASC, id DESC')->select();

//

        $systems = M('system')->where('id'==1)->find();

        $this->assign('systems',$systems);

        $this->assign('p',I('p'));

        $this->assign('cate_id',$cate_id);

        $this->assign('status',$status);

        $this->assign('starttime',$starttime);

        $this->assign('endtime',$endtime);

        $this->assign('keyword',$keyword);

        $this->assign('infos', $infos);

        $this->assign('page', $pagelist);

        $this->assign('categorys', $cates);

        $this->assign('categorys_1', $categorys_1);

        $this->display();

        echo $cates['id'];

    }





////注册提醒

//    public function sendOrderNotice(){

//        //查询order表是否有新订单

//        $NewOderCount=post::getNewOderCount();

////        $NewOderCount=M('post')->find()::getNewOderCount();

////        echo $NewOderCount;die;

//        if ($NewOderCount) {

//            echo json_encode($NewOderCount);

//        } else {

//            echo 0;

//        }

//    }

    /**

     * 黑名单

     */

    public function blacklist($id){

        if($id != null || $id !=""){

            $model = D('Post')->where(array('id'=>$id));

            $list = $model->where(array('id'=>$id))->select();



            /*拉黑*/

            if($list[0]['blacklist'] == '0'){

                $model -> execute("update tp_post set blacklist='1' where id=$id");

                echo "<script>alert('拉黑成功')</script>";

            }

            /*取消拉黑*/

            if($list[0]['blacklist'] == '1'){

                $model -> execute("update tp_post set blacklist='0' where id=$id");

                echo "<script>alert('取消拉黑成功')</script>";

            }

            $this->redirect('Post/index');

        }

        if(IS_POST){

            $this->display();

        }

    }











    /**

     * 添加信息

     */

    public function add() {

        //默认显示添加表单

        if (!IS_POST) {

            $this->assign("category", getSortedCategory(M('category')->select()));

            $this->display();

        }

        if (IS_POST) {

            //如果用户提交数据

            $model = D("Post");

            $model->time = time();

            $model->user_id = 1;

            if (!$model->create()) {

                // 如果创建失败 表示验证没有通过 输出错误提示信息

                $this->error($model->getError());

                exit();

            } else {

                if ($model->add()) {

                    $this->success("添加成功", U('post/index'));

                } else {

                    $this->error("添加失败");

                }

            }

        }

    }



    /**

     * 更新信息信息

     * @param  [type] $id [信息ID]

     * @return [type]     [description]

     */

    public function update($id) {

        $p = I('p');

        $id = intval($id);

        //默认显示添加表单



        if (IS_POST) {



            $model = D("Post");

            $model->audit_time = time();

			$model->edit_user = session('username');

		

			$data = $model->create();

			$data['handsel'] = floatval($data['handsel']); //防止未填金额

			if($data['status'] > 0){

				$data['audit_time'] = time();

				$data['edit_user'] = session('username');

			}

            if (!$data) {

                $this->error($model->getError());

            } else {

                $goBack = I("post.goBack");

                $goBack  = !empty($goBack) ? $goBack : U("post/index");

                //header("Location:".$goBack);

                if ($model->save($data)) {
//                    $this->success("更新成功", $goBack);
                    redirect($goBack);

                } else {

                    $this->error("更新失败", $goBack);

                }

            }

        }else{

            $model = M('post')->where("id= %d", $id)->find();

            $goBack = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : U("post/index");

            $this->assign("goBack", $goBack);

            $this->assign("category", getSortedCategory(M('category')->select()));

            $this->assign('post', $model);

            #dump($aaa);

            $this->display();

        }

    }











//    这是批量审核通过

    public function batchPass(){

        #echo 1;die;

        if(IS_AJAX){

//            echo ssss;die;

            $ids = I("post.ids");

            $value = I("post.value");

//            print_r($value);die;

            if($ids == "" || !preg_match("#[0-9,]{1,}#", $ids)){

                outputjson(array('status'=>-1, 'msg'=>'请指定要审核的ID！'));

            }

            $idsAry = explode(",", $ids);

            D("Post")->where(array('id'=>array("IN", $ids)))->data(array('status'=>1,'memo'=>$value))->save();

            outputjson(array("status"=>1, "msg"=>"批量审核成功！"));

        }else{

            #echo 1;die;

            outputjson(array('status'=>-1, 'msg'=>'无权限操作！'));

        }

    }





    //    这是批量审核不通过

    public function batchNoPass(){

        #echo 1;die;

        if(IS_AJAX){

//            echo ssss;die;

            $ids = I("post.ids");

            $value = I("post.value");

//            print_r($value);die;

            if($ids == "" || !preg_match("#[0-9,]{1,}#", $ids)){

                outputjson(array('status'=>-1, 'msg'=>'请指定要审核的ID！'));

            }

            $idsAry = explode(",", $ids);

            D("Post")->where(array('id'=>array("IN", $ids)))->data(array('status'=>2,'memo'=>$value))->save();

            outputjson(array("status"=>1, "msg"=>"批量审核不通过成功！"));

        }else{

            #echo 1;die;

            outputjson(array('status'=>-1, 'msg'=>'无权限操作！'));

        }

    }











//    这是批量删除

    public function batchDelete(){

        if(IS_AJAX){

            $ids = I("post.ids");

            if($ids == "" || !preg_match("#[0-9,]{1,}#", $ids)){

                outputjson(array('status'=>-1, 'msg'=>'请指定要删除的ID！'));

            }

            $idsAry = explode(",", $ids);

            D("Post")->where(array('id'=>array("IN", $ids)))->delete();

            outputjson(array("status"=>1, "msg"=>"批量删除成功！"));

        }else{

            outputjson(array('status'=>-1, 'msg'=>'无权限操作！'));

        }

    }



    /**

     * 删除信息

     * @param  [type] $id [description]

     * @return [type]     [description]

     */

    public function delete($id) {

        $id = intval($id);



            $model = M('post');

            $result = $model->where("id= %d", $id)->delete();

            $goBack = I("server.HTTP_REFERER");

            $goBack  = !empty($goBack) ? $goBack : U("post/index");

            if ($result) {

                $this->success("删除成功",$goBack);

            } else {

                $this->error("删除失败",$goBack);

            }

        }





}

