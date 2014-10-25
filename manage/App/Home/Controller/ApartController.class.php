<?php
namespace Home\Controller;
use Think\Controller;
/*
*前台公用控制器
*/
class ApartController extends CommonController {

	public function index(){

		$rid = session('apart_id');//部门id
		$uid = session('uid');//个人id
		$lid = session('level_id');//个人level id
/*************************************************************************************/
		/*if ($_SESSION['username'] !== 'admin') {
			
			if ($rid !== $_SESSION['apart_id']) {
					$this->error('没有权限');
				};
		}*/
		//返回用户姓名信息到head上
		if(isset($_SESSION['username'])) {

			$username = $_SESSION['username'];
			$this->assign('log', $username);
		};
		$apart = M('apartment')->where(array('id' => $_SESSION['apart_id']))->select();
		$apart = $apart[0]['name'];
		
		//把部门的名称加载上
		$this->assign('apart', $apart);

/*************************************倒计时*****************************************/
		//最近任务截止时间
		$deadline = M('work')
		->join("LEFT JOIN work_user ON work_user.work_id = work.id")
		->join("LEFT JOIN work_level ON work_level.work_id = work.id")
		->where("user_id = $uid OR (apart_id = $rid AND level_id = $lid)")
		->order('deadline desc')
		->limit(1)
		->getField("deadline",true);
		
		$deadline = strtotime($deadline[0]);
		
		$lefttime = floor(($deadline-time())/60/60/24);

		$lefttime = ($lefttime<0) ? 0:$lefttime;

		//距离任务完成还有几天
		$this->assign('lefttime', $lefttime);

/***************************************我的任务***************************************/
	
		$workUp = M('work_up');
		$finished_id = $workUp->where("user_id = $uid")->getField("work_id",true);
		//已经完成的任务
		$finished = array();
		if ($finished_id == null) {
			$finished_id = array(
				0 => null,
				);
		}else{
			foreach ($finished_id as $value) {
				$work = M('work')->where("id = $value")->find();
					$finished[] = $work;
				}
		}

		$Work = M('work');
		$allWork_id = $Work
						->join("LEFT JOIN work_user ON work_user.work_id = work.id")
						->join("LEFT JOIN work_level ON work_level.work_id = work.id")
						->where("user_id = $uid OR (apart_id = $rid AND level_id = $lid)")
						->getField("id",true);
						
		$unfinished_id = array_diff($allWork_id,$finished_id);
		$weijiao_id = array();
		$guoqi_id = array();

		foreach ($unfinished_id as $value) {
			if (strtotime($Work->where("id = $value")->getField('deadline')) > time()){
				array_push($weijiao_id, $value);
			}else {
				array_push($guoqi_id, $value);
			}
		}
		/*dump($allWork_id);
		dump($finished_id);
		dump($unfinished_id);
		die;*/
		

		$weijiao = array();
		foreach ($weijiao_id as  $value) {
			$work = M('work')->where("id = $value")->find();
			$weijiao[] = $work;
		}
		$guoqi = array();
 		foreach ($guoqi_id as $value) {
 			$work = M('work')->where("id = $value")->find();
 			$guoqi[] = $work;
 		}
 		//过期的任务的数组
 		$this->assign('guoqi', $guoqi);
 		//未交的任务数组
 		$this->assign('weijiao', $weijiao);
 		//完成的任务数组
 		$this->assign('finished', $finished);

 		//已经完成的任务 数
 		$h = count($finished);
 		$this->assign('over', $h);

 		//待完成的任务 数
 		$e = count($weijiao);
 		$this->assign('going', $e);

 		//过期的任务 数
 		$g = count($guoqi);
 		$this->assign('failed', $g);

 		//提交列表

 		$this->assign('data', $data);
		
 /****************************************部门任务***********************************/
 		$time = time();
     	//我部门所有的任务
 		$apart_all  =  M('apart_work')
 				->join("LEFT JOIN work ON apart_work.work_id = work.id")
 				->where("apart_id = $rid")
 				->order('id desc')
 				->limit(6)
 				->select();
 		$apart_work_id = M('apart_work')
 				->where("apart_id = $rid")
 				->getField('work_id', true);
     	//无效任务
 		$invalid_list = array();//部门过期的任务
 		foreach ($apart_all as $key => $v) {
 			if ($time > strtotime($v['deadline'])) {
 				array_push($invalid_list, $v);
 			}
 		}

 		//有效任务
 		$effective_list = array();//部门有效的任务
 		foreach ($apart_all as $key => $v) {
 			if ($time < strtotime($v['deadline'])) {
 				array_push($effective_list, $v);
 			}
 		}
     	$this->assign('invalid_list', $invalid_list);// 赋值数据集
     	$this->assign('effective_list', $effective_list);// 赋值数据集

     	//相关人员
 		$work_user_acc  = array();
 		foreach ($apart_work_id as $value) {
 			$work = M('work_level')
 					->join("LEFT JOIN level ON work_level.level_id = level.id")
 					->where(" work_id = $value ")
 					->field('work_id, name')
 					->select();
 			
 			array_push($work_user_acc, $work);
 		}
 		/*dump($work_user_acc);
 		dump($effective_list);
 		die;*/
 		$this->assign('acc', $work_user_acc);

 /**********************************资源共享******************************************/

     	$Resource = M('resource'); 
     	$Resource_list = $Resource->order('id desc')->limit(13)->select(); 
     	$this->assign('Resource_list',$Resource_list);

/********************************问答首页**********************************************/
    	
    	$Question = M('question'); // 实例化User对象
    	
    	// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
    	$Question_list = $Question
    					->join("LEFT JOIN user ON question.uid = user.id")
    					->select();
    	$this->assign('Question_list',$Question_list);// 赋值数据集
/**********************************通讯录*******************************************/
  
    	$info_list = M('user')
    	->join("RIGHT JOIN information ON user.id = information.uid")
    	->select();
    	$this->assign('info_list',$info_list);
/*************************************提交列表***************************************/
    	$upworklist = M('work_up')
    	->join("LEFT JOIN apart_user ON work_up.user_id = apart_user.user_id")
    	->join("LEFT JOIN user ON user.id = work_up.user_id")
    	->join("LEFT JOIN work ON work.id = work_up.work_id")
    	->where("apart_id = $rid")
    	->select();
    	$this->assign('upworklist',$upworklist);

  /******************************最新任务（通知）**************************************/
    	
    	$apart_id = session('apart_id');
    	$new_notice = M('notice')
    				  ->join("LEFT JOIN apart_notice ON notice.id = apart_notice.notice_id")
    				  ->where("apart_notice.apart_id = $apart_id")
    				  ->order("createtime desc")
    				  ->find();
    	$this->assign('new_notice',$new_notice);

/*************************************************************************************/
        $this->display();
	}

	public function ajax()
	{
		 
		$question_id =strip_tags($_POST['content']) ;
	
		$content = M('reply')
				->where("question_id = $question_id")
				->join('LEFT JOIN user ON reply.uid = user.id')
				//->order('time desc')
				->field('username, content, time')
				->select();
		
		
		$data['status']  = 200;
		$data['content'] = $content;
		$this->ajaxReturn($data);

	
	}
	
	public function answer_reply()
	{
		$uid = I('get.id');
		$reply = I('post.your_reply');
		$data = array(
				'question_id'=> $question,
				'uid' => $uid ,
				'content' => $reply,
				'time' => time(),
		);
		M('reply')->where();
	}
	
	public function  ajax1()
	{
		$question_id =strip_tags($_POST['content']);
		
		$content = M('question')
		->where("question_id = $question_id")
		->join("LEFT JOIN user ON question.uid = user.id")
		->field('username, content, time, title, question_id')
		->find();
		
		
		$data['status']  = 200;
		$data['content'] = $content;
		$this->ajaxReturn($data);
	}
	
	

	public function  ajax2()
	{
		$question_id = strip_tags($_POST['username']);
		$content =strip_tags($_POST['content']);
		$uid = session('uid');

		if($content==null)
		{
			$data['status']  =0;
			$this->ajaxReturn($data);
		}
		$data = array(
				'question_id'=> $question_id,
				'uid'=>	$uid,
				'content'=>$content,
				'time'=>time(),			
		);
		$content = M('reply')
					->data($data)
					->add();
		M('question')
			->where("question_id = $question_id")
			->setInc('reply_count');
	
		$data['status']  = 200;
		
		$this->ajaxReturn($data);
	}

}
?>