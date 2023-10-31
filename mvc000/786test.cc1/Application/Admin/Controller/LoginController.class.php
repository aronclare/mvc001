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
use Think\Controller;
 

class LoginController extends Controller {
    //登陆主页
    public function index(){
        $this->display();
    }
    //登陆验证
    public function login(){
        if(!IS_POST)$this->error("非法请求");
        $member = M('member');
        $username =I('post.username','','addslashes');
        $password =I('post.password');

        //dump($password_sum);die;
        $code = I('verify','','strtolower');
        //验证验证码是否正确
        // if(!($this->check_verify($code))){
        //     $this->error('验证码错误');
        // } 
         if((!$this->check_verify($code))){
            $this->error('验证码错误');
        } 
        
        
//         import('Extend.GoogleAuthenticator');
//         $ga = new \GoogleAuthenticator();
 //		$checkResult = $ga->verifyCode(C("GOOGLE_AUTH"), $code, 0);
//         if(!$checkResult) {
// 		   $this->error('验证码错误');
// 			return;
// 		}
        
        
        

       $user = $member->where(array('username'=>$username))->find();
       
     // var_dump($user);exit;
      if(!$user){
            $this->error('账号或密码错误 :(') ;
        }elseif($user['type'] == 1) {
            $this->error('您没权限登陆后台 :(');
        }elseif($user['status'] == 0){
            $this->error('账号被禁用，请联系超级管理员 :(') ;
        }

		$password_new = md5(md5($password).$user['secert_code']);
		
	//	echo $password_new;exit;
		
        if($user['password'] != $password_new){
            $this->error('账号或密码错误 :(') ;
        } 

        //更新登陆信息
        $data =array(
            'id' => $user['id'],
            'update_at' => time(),
            'login_ip' => get_client_ip(),
        );
        //如果数据更新成功  跳转到后台主页
        if($member->save($data)){
            session('adminId',$user['id']);
            session('username',$user['username']);
            $this->success("登陆成功",U('Index/index'));
        }
    }
    //验证码
    public function verify(){
        $Verify = new \Think\Verify();
        $Verify->codeSet = '0123456789';
        $Verify->fontSize = 13;
        $Verify->length = 4;
        $Verify->entry();
    }
    protected function check_verify($code){
        $verify = new \Think\Verify();
        return $verify->check($code);
    }

    public function logout(){
        session('adminId',null);
        session('username',null);
        redirect(U('Login/index'));
    }

  public function getGoogleAuth(){
        import('Extend.GoogleAuthenticator');
        $ga = new \GoogleAuthenticator();
       // $secret = $ga->createSecret();

       $secret =  C("GOOGLE_AUTH") ;
        $qrCodeUrl = $ga->getQRCodeGoogleUrl('786yh.com', $secret);   
        //echo "Secret is: ".$secret."\n\n";
    	echo "<img src='".$qrCodeUrl."'>";

    }

/*require_once('../includes/init.php');
require_once(BASE_PATH . 'includes/GoogleAuthenticator.php');
if(isset($_GET['act']) && $_GET['act'] == 'register'){
$ga = new PHPGangsta_GoogleAuthenticator();
    //创建一个新的"安全密匙SecretKey"
    //把本次的"安全密匙SecretKey" 入库,和账户关系绑定,客户端也是绑定这同一个"安全密匙SecretKey"
//	$secret = $ga->createSecret();
$secret = "YD5VAICADISFP2S2";
//	echo "安全密匙SecretKey: ".$secret."\n\n";
$qrCodeUrl = $ga->getQRCodeGoogleUrl('696qhb.cc', $secret); //第一个参数是"标识",第二个参数为"安全密匙SecretKey" 生成二维码信息
    //echo "Google Charts URL for the QR-Code: ".$qrCodeUrl."\n\n"; //Google Charts接口 生成的二维码图片,方便手机端扫描绑定安全密匙SecretKey
echo "<img src='".$qrCodeUrl."'>";
exit();
}*/




}