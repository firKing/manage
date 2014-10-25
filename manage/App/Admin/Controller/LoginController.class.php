<?php
namespace Admin\Controller;
use Think\Controller;
/*
*后台登陆控制器
*/
class LoginController extends Controller {

	public function index(){
        $this->display();
    }

    //登录验证
    public function login(){
    	if(!IS_POST){
    		$this->error('页面不存在');
    	}

        $verify = new \Think\Verify();

        if(!$verify->check(I('post.code'))){
        	$this->error('验证码错误');
        }

		$username = I('post.username');
		$pwd = I('post.password', '', 'md5');
		$user = M('user')->where(array('username' => $username))->find();

		if (!$user || $user['password'] != $pwd) {
			$this->error('账号或密码错误');
		}

		if ($user['lock']) {
			$this->error('用户被锁定');
		}

		$data = array(
			'id' => $user['id'],
			'logintime' => time(),
			'loginip' => get_client_ip(),
			);
		M('user')->save($data);

		session(C('USER_AUTH_KEY'), $user['id']);
		session('username', $user['name']);
		session('logintime', date('Y-m-d H:i:s', $user['logintime']));
		session('loginip', $user['loginip']);
		
		//超级管理员识别
		if ($user['user_name'] == C('RBAC_SUPERADMIN')) {
			session(C('ADMIN_AUTH_KEY'), true);
		}
		//读取用户权限
		$Rbac = new \Org\Util\Rbac();
		$Rbac->saveAccessList();

		$this->success('登陆成功', __ROOT__ . '/index.php/Admin/Index/index');
    }

    //生成验证码
    public function verify () {
    	$config = array(
			'fontSize' => 30, // 验证码字体大小
			'length' => 4, // 验证码位数
			'useNoise' => true, // 关闭验证码杂点
		);
    	$verify = new \Think\Verify($config);
    	$verify->entry();
    }
}


?>