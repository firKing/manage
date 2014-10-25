<?php
namespace Admin\Controller;
use Think\Controller;
/**
* 
*/
class RbacController extends CommonController {

	//用户列表
	public function index(){
		//取出用户信息
		$User = M('user');
		$searchName = I('search');

		if ($searchName !== "") {

			$count = $User
						->join('LEFT JOIN user_dept_role ON user.user_id = user_dept_role.user_id')
						->join('LEFT JOIN role ON user_dept_role.role_id = role.id')
						->join('LEFT JOIN department ON user_dept_role.dept_id = department.dept_id')
						->where(array('user_name' => $searchName))
						->count();

			$Page = new \Think\Page($count,7);// 实例化分页类

			$list = $User->limit($Page->firstRow.','.$Page->listRows)
						->join('LEFT JOIN user_dept_role ON user.user_id = user_dept_role.user_id')
						->join('LEFT JOIN role ON user_dept_role.role_id = role.id')
						->join('LEFT JOIN department ON user_dept_role.dept_id = department.dept_id')
						->where(array('user_name' => $searchName))
						 ->select();
		}else{

			$count = $User->join('LEFT JOIN user_dept_role ON user.user_id = user_dept_role.user_id')
						->join('LEFT JOIN role ON user_dept_role.role_id = role.id')
						->join('LEFT JOIN department ON user_dept_role.dept_id = department.dept_id')
						->count();

			$Page = new \Think\Page($count,7);// 实例化分页类

			$list = $User->join('LEFT JOIN user_dept_role ON user.user_id = user_dept_role.user_id')
						->join('LEFT JOIN role ON user_dept_role.role_id = role.id')
						->join('LEFT JOIN department ON user_dept_role.dept_id = department.dept_id')
						->limit($Page->firstRow.','.$Page->listRows)
						->select();			
		}
		dump($list);
		die;
    	$show = $Page->show();// 分页显示输出
    	$this->assign('user',$list);// 赋值数据集
    	$this->assign('page',$show);// 赋值分页输出

    	//取出与用户有关的部门信息和职位信息
    	$apart = M('apart_user')->select();
    	$level = M('level_user')->select();
    	$this->assign('apart', $apart);
    	$this->assign('level', $level);
        $this->display();
	}

	//角色列表
	public function role(){
		$role = M('role')->select();
		$this->assign('role',$role)->display();
	}

	//部门列表
	public function dept(){
		$dept = M('department')->select();
		$this->assign('dept',$dept)->display();
	}

	//节点列表
	public function node(){
		$field = array('id', 'name', 'title', 'pid');
		$node = M('node')->field($field)->order('sort')->select();
		$node = node_merge($node);
		$this->assign('node',$node)->display();
	}

	//添加用户界面
	public function addUser(){
		$role = M('role')->select();
		$dept = M('department')->select();

		$this->assign('role', $role);
		$this->assign('dept', $dept);

		$this->display();
	}

	//添加用户表单管理
	public function addUserHandle(){
		//用户信息
		if (!I('username') || !I('password', '', 'md5')) {
			$this->error('用户名密码不能为空');
		}
		foreach (I('info') as $v) {
			if ($v == null) {
				$this->error('所属部门不能为空');
			}
		}
		$user = array(
			'user_name' => I('username'),
			'user_password' => I('password', '', 'md5'),
			'user_log_time' => time(),
			'user_log_ip' => get_client_ip(),
			'user_status' => 1
			);

		//所属部门
		$info = array();
		if($uid = M('user')->add($user)){

			//添加部门和职务信息
			foreach (I('info') as $v) {
				$info[] = array(
					'dept_id' => $v['dept'],
					'role_id' => $v['role'],
					'user_id' => $uid
					);
			}
			M('user_dept_role')->addAll($info);

			$this->success('添加用户成功', U('Admin/Rbac/index'));
		}else{
			$this->error('添加用户失败');
		}
	}

	//删除用户表单管理
	public function deleteUser(){
		$r1 = M('user')->where(array('id' => I('uid')))->delete();
		$r2 = M('role_user')->where(array('user_id' =>I('uid')))->delete();
		$r3 = M('apart_user')->where(array('user_id' =>I('uid')))->delete();
		$r4 = M('level_user')->where(array('user_id' =>I('uid')))->delete();
		if ($r1 && $r2 && $r3 && $r4) {
			$this->success('删除用户成功');
		}else{
			$this->error('删除用户失败');
		}
	}

	//添加角色
	public function addRole(){
		$this->display();
	}

	//添加角色表单处理
	public function addRoleHandle(){
		if (!I('name') || !I('remark')) {
			$this->error('名称或描述不能为空');
		}
		$result = M('role')->add(I('post.'));

		if($result){
			$this->success('添加角色成功', U('Admin/Rbac/role'));
		}else{
			$this->error('添加失败');
		}
	}

	//删除角色表单管理
	public function deleteRole(){
		$r1 = M('role')->where(array('id' => I('role_id')))->delete();
		$r2 = M('role_user')->where(array('role_id' =>I('role_id')))->delete();
		$r3 = M('access')->where(array('role_id' =>I('role_id')))->delete();
		if ($r1 || $r2 || $r3) {
			$this->success('删除角色成功');
		}else{
			$this->error('删除角色失败');
		}
	}

	//添加节点
	public function addNode(){
		$pid = I('get.pid', 0, 'intval');
		$level = I('level', 1, 'intval');
		$this->assign('pid', $pid);
		$this->assign('level', $level);

		switch ($this->level) {
			case 1:
				$this->type = '应用';
				break;	
			case 2:
				$this->type = '控制器';
				break;
			case 3:
				$this->type = '方法';
				break;
		}

		$this->display();
	}

	//添加节点表单处理
	public function addNodeHandle(){

		$result = M('node')->add(I('post.'));

		if($result){
			$this->success('添加应用成功', U('Admin/Rbac/node'));
		}else{
			$this->error('添加失败');
		}
	}

	//删除节点表单处理
	public function deleteNode(){
		$r1 = M('node')->where(array('id' => I('id')))->delete();
		$r2 = M('access')->where(array('node_id' =>I('id')))->delete();
		if ($r1 || $r2) {
			$this->success('删除节点成功');
		}else{
			$this->error('删除节点失败');
		}
	}

	//添加部门
	public function addDept(){
		$this->display();
	}

	//添加角色表单处理
	public function addDeptHandle(){
		if (!I('dept_name')) {
			$this->error('名称不能为空');
		}
		$result = M('department')->add(I('post.'));

		if($result){
			$this->success('添加部门成功', U('Admin/Rbac/dept'));
		}else{
			$this->error('添加失败');
		}
	}

	//删除角色表单管理
	public function deleteDept(){
		$r1 = M('department')->where(array('dept_id' => I('dept_id')))->delete();
		$r2 = M('user_dept_role')->where(array('dept_id' =>I('dept_id')))->delete();
		if ($r1 || $r2) {
			$this->success('删除部门成功');
		}else{
			$this->error('删除部门失败');
		}
	}

	//配置权限
	public function access(){
		$rid = I('rid', 0, 'intval');

		$field = array('id', 'name', 'title', 'pid');
		$node = M('node')->order('sort')->field($field)->select();
		
		//原有权限
		$access = M('access')->where(array('role_id' => $rid))->getField('node_id', true);

		$node = node_merge($node,$access);

		$this->assign('node', $node);
		$this->assign('rid', $rid);
		$this->display();
	}

	//修改权限
	public function setAccess(){
		$rid = I('rid', 0, 'intval');
		$db = M('access');

		//清空原权限
		$db->where(array('role_id' => $rid))->delete();

		//组合新权限
		$data= array();
		foreach (I('access') as $v) {
			$tmp = explode('_', $v);
			$data[] = array(
				'role_id' => $rid,
				'node_id' => $tmp[0],
				'level' => $tmp[1]
				);
		}

		//插入新权限
		$result = $db->addAll($data);
		if($result){
			$this->success('修改权限成功', U('Admin/Rbac/role'));
		}else{
			$this->error('修改失败');
		}
	}
}
?>