<?php
namespace Home\Controller;
use Think\Controller;
/*
*后台登陆控制器
*/
class LoginController extends Controller {

    //登录验证
    public function login(){
    	if(!IS_POST){
    		$this->error('页面不存在');
    	}

		$username = I('post.log');
		$pwd = I('post.pwd', '', 'md5');
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
		session('username', $user['username']);
		session('logintime', date('Y-m-d H:i:s', $user['logintime']));
		session('loginip', $user['loginip']);

		//把自己是哪个部门的存进去...实在太烦了--
		$Userre = D('UserRelation');
		$userre = $Userre->field('password', true)->where(array('id' => $user['id']))->relation(true)->select();
		$self_apart_id = $userre[0]['apartment'][0]['id'];
		session('apart_id', $self_apart_id);

		//把自己的等级存进去...
		$Userle = D('UserRelation');
		$userle = $Userle->field('password', true)->where(array('id' => $user['id']))->relation(true)->select();
		$self_level_id = $userle[0]['level'][0]['id'];
		session('level_id', $self_level_id);
		
		//超级管理员识别
		if ($user['username'] == C('RBAC_SUPERADMIN')) {
			session(C('ADMIN_AUTH_KEY'), true);
		}
		//读取用户权限
		$Rbac = new \Org\Util\Rbac();
		$Rbac->saveAccessList();

		$this->success('登陆成功', __ROOT__ . '/index.php/Home/Index/index');
    }
}


?>