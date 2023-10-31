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

class IndexController extends BaseController{

    public function index(){
        $Category = M('category');
        $Post = M('post');
        $member = M('member');
        $Membersum = $member->count();
        $Postsum = $Post->count();
        $Postetx = $Post->where('status=0')->field(array('status'))->count();
        $Postpass = $Post->where('status=1')->field(array('status'))->count();
        $Postnopass = $Post->where('status=2')->field(array('status'))->count();
//        array('id','concat(name,'-',id)'=>'truename','LEFT(title,7)'=>'sub_title'))->
        $Categorysum = $Category->count();
        $this->assign('Categorysum',$Categorysum);
        $this->assign('Postetx',$Postetx);
        $this->assign('Postpass',$Postpass);
        $this->assign('Postnopass',$Postnopass);
        $this->assign('Postsum',$Postsum);
        $this->assign('Membersum',$Membersum);
        $this->display();
    }
    
    
    
    

    
    
}
