<?php
namespace Admin\Controller;
use Think\Controller;
/**
 * 任务管理控制器
 */
class WorkController extends CommonController{

	//任务列表
	public function index(){
		
		//先找到自己是哪个部门的
		$User = D('UserRelation');
		$user = $User->field('password', true)->where(array('id' => $_SESSION['uid']))->relation(true)->select();
		$self_apart_id = $user[0]['apartment'][0]['id'];

		//再看这个部门有那些任务
		$Work = D('ApartRelation');
		$work = $Work->field('password', true)->where(array('id' => $self_apart_id))->relation(true)->select();
		$apart_work = $work[0]['work'];

		//再把找到的任务塞到模板里面
		$this->assign('work', $apart_work);
		$this->display();
	}

	//发布任务界面
	public function addWork(){

		//查找跟自己是同一个部门的人
		$Other = D('ApartRelation');
		$other = $Other->field('password', true)->where(array('id' => $_SESSION['apart_id']))->relation(true)->select();
		$member = $other[0]['user'];
		
		$level = M('level')->select();

		//加到模板中
		$this->assign('level', $level);
		$this->assign('member', $member);
		$this->display();
	}

	//判断数组是否为空并返回不为空的数组的数据
	private function judge($a, $b){
			$res = array();

			if(($a[0])){
				array_push($res, $a);
				$flag = 1;
			}
			if(($b[0])){
				array_push($res, $b);
				$flag = 2;
			}
			if(count($res) == 1){
				return array(
					'data' => $res[0],
					'flag' => $flag
				);
			};
	}

	//发布任务处理
	public function addWorkHandle(){
		dump(time(I('post.deadline')));die;
		//判断数据是否为空
		if (I('post.title') == null) {
			$this->error('标题不能为空');
		}
		if (I('post.deadline') == null) {
			$this->error('截止时间不能为空');
		}

		if (I('post.content') == null) {
			$this->error('内容不能为空');
		}

		$arr = $this->judge(I('level_id'), I('member_id'));
		if(!$arr['data']){
			$this->error('请分配人员');
		}else{
			foreach ($arr['data'] as $key => $value) {
				if ($value == null) {
					$this->error('请分配人员');
				}
			}
		}

		//获取数据
		$data = array(
			'title' => I('post.title'),
			'deadline' => I('post.deadline'),
			'content' => I('post.content'),
			'createtime' => time()
			);

		//将任务关联到人或者级别
		$member = array();
		$level = array();
		$work_id = M('work')->add($data);
		if (!$work_id==null) {

			//添加到任务人员关联表
			if ($arr['flag'] == 1) {
				foreach (I('level_id') as $v) {
				$level[] = array(
					'level_id' => $v,
					'work_id' => $work_id,
					'apart_id' => $_SESSION['apart_id']
					);
				}
				M('work_level')->addAll($level);
			}
			if ($arr['flag'] == 2) {
				foreach (I('member_id') as $v) {
				$member[] = array(
					'user_id' => $v,
					'work_id' => $work_id
					);
				}
				M('work_user')->addAll($member);
			}

			//添加到任务部门关联表
			$data = array(
				'apart_id' => $_SESSION['apart_id'],
				'work_id' => $work_id
				);
			M('apart_work')->add($data);

			$this->success('发布任务成功', U('Admin/Work/index'));
		}else{
			$this->error('发布任务失败');
		}
	}

	//修改任务界面
	public function reviseWork(){

		$work = M('work')->where(array('id' => I('work_id')))->select();

		//查找跟自己是同一个部门的所有人
		$Other = D('ApartRelation');
		$other = $Other->field('password', true)->where(array('id' => $_SESSION['apart_id']))->relation(true)->select();
		$member = $other[0]['user'];
		$level = M('level')->select();

		//加到模板中
		$this->assign('level', $level);
		$this->assign('member', $member);
		$this->assign('rework', $work);
		$this->display();

	}

	//修改任务表单处理
	public function reviseWorkHandle(){

		//判断数据是否为空
		if (I('post.title') == null) {
			$this->error('标题不能为空');
		}
		if (I('post.deadline') == null) {
			$this->error('截止时间不能为空');
		}
		if (I('post.content') == null) {
			$this->error('内容不能为空');
		}
		foreach (I('member_id') as $v) {
			if ($v == null) {
				$this->error('人员分配不能为空');
			}
		}

		//获取数据
		$data = array(
			'title' => I('post.title'),
			'deadline' => I('post.deadline'),
			'content' => I('post.content'),
			'createtime' => time()
			);
		$work_id = I('post.work_id');

		//将任务关联到人
		//保存修改过后的任务
		$r1 = M('work')->data($data)->where(array('id' => $work_id))->save();
		//删了之前分配的关联
		$r2 = M('work_user')->where(array('work_id' => $work_id))->delete();
		$r3 = M('work_level')->where(array('work_id' => $work_id))->delete();
		//新增修改过后的关联
		$member = array();
		if ($r1 && ($r2 || $r3)) {
			foreach (I('member_id') as $v) {
				$member[] = array(
					'user_id' => $v,
					'work_id' => $work_id
					);
			}

			//添加任务
			M('work_user')->addAll($member);
			$this->success('修改任务成功', U('Admin/Work/index'));
		}else{
			$this->error('修改任务失败');
		}

	}

	//发布通知界面
	public function addNotice(){

		//查找这个部门有关的通知
		/*$Notice = D('ApartRelation');
		$notice = $Notice->field('password', true)->where(array('id' => $_SESSION['apart_id']))->limit(1)->relation(true)->select();

		$notice = $notice[0]['notice'];*/
		$Notice = M('notice');
		$notice = $Notice
				->join('LEFT JOIN apart_notice ON apart_notice.notice_id = notice.id')
				->where(array('apart_id' => $_SESSION['apart_id']))
				->order('id desc')
				->find();
		
		$this->assign('notice', $notice);
		$this->display();
	}

	//发布通知表单处理
	public function addNoticeHandle(){

		//验证内容是否有意义
		if (I('post.title') == null) {
			$this->error('标题不能为空');
		}
		if (I('post.content') == null) {
			$this->error('内容不能为空');
		}

		//提取数据
		$data = array(
			'title' => I('post.title'),
			'content' => I('post.content'),
			'createtime' => time()
			);

		//将数据插入数据库
		if ($notice_id = M('notice')->add($data)) {

			//添加到任务部门关联表
			$data = array(
				'apart_id' => $_SESSION['apart_id'],
				'notice_id' => $notice_id
				);
			M('apart_notice')->add($data);

			$this->success('发布通知成功');
		}
	}

	//查看提交的任务
	public function subedWork(){
		$work_id = I('work_id');
		
		$work_up = M('work_up')
					->join('LEFT JOIN user ON work_up.user_id = user.id')
					->where("work_id = $work_id")->select();
	
		$this->assign('work_up', $work_up); 
		$this->display();
		
		/*<a href="{:U('Admin/Work/downWork', array('url' => '__ROOT__/Uploads/work/{$v.savepath}'))}"></a>*/
	}

	//下载文件
	public function downWork(){
		$vid = I("vid");
			
		$url = M('work_up')->where("work_up_id = $vid")->getField('savepath');
		
		downlode($url);
	}
}
?>