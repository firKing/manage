<?php
namespace Admin\Controller;
use Think\Controller;
/*
*后台首页控制器
*/
class IndexController extends CommonController {

    //配置页面
    public function conf(){
        $this->display();
    }

	//后台首页
    public function index(){
        
        $this->display();
    }

    //退出登录
    public function logout(){
    	session_unset();
    	session_destroy();
    	$this->redirect('Home/Index/index');
    }

    //修改密码处理
    public function pwdHandle(){
        if(!IS_POST){
            $this->error('页面不存在');
        }

        $pass = I('pass');//旧密码
        $newPass = I('newPass');//新密码
        $newPassEnter = I('newPassEnter');//新密码again

        //看密码是否为空
        if ($newPass==null || $newPassEnter==null || $pass==null) {
            $this->error('密码不能为空值');
        }

        //验证两次输入的密码是否一致
        if ($newPass !== $newPassEnter) {
            $this->error('两次输入的新密码不一致');
        }

        //验证用户身份
        $uid  = $_SESSION['uid'];
        $pwd  = I('post.pass', '', 'md5');
        $user = M('user')->where(array('id' => $uid))->find();

        if (!$user || $user['password'] != $pwd) {
            $this->error('旧密码错误');
        }

        if ($user['lock']) {
            $this->error('用户被锁定');
        }

        $data = array(
            'password' => I('post.newPass', '', 'md5')
            );

        M('user')->data($data)->where(array('id' => $uid))->save();
        $this->success('修改成功', U('Admin/Index/logout'));
    }

    //修改个人信息处理
    public function infHandle(){
    	if(!IS_POST){
            $this->error('页面不存在');
        }
        $uid  = $_SESSION['uid'];
        //判断是否更新个人信息
        $info = M('information');
        
        $user_info = $info->where(array('uid' => $uid))->find();
        if (!$user_info) {
            //判断用户信息是否存在,不存在就添加
            $data['phone'] = I('post.phone');
            $data['email'] = I('post.email');
            $data['txqq'] = I('post.qq');
            $data['uid'] = $uid;
            $info->data($data)->add();
        }else{
            //如果个人信息存在就更新
            //分别判断,空的就不修改了
            if (!I('post.phone')==null) {
            $data['phone'] = I('post.phone');
            $info->data($data)->where(array('uid' => $uid))->save();
            }
            if (!I('post.email')==null) {
                $data['email'] = I('post.email');
                $info->data($data)->where(array('uid' => $uid))->save();
            }
            if (!I('post.qq')==null) {
                $data['txqq'] = I('post.qq');
                $info->data($data)->where(array('uid' => $uid))->save();
            }
        }
        
        $this->success('修改信息成功');
    }
}