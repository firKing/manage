<?php
/**
 * 问答系统模块
 * 问答详情页
 * @param array $title 问题题目
 * @param array $reply_list 回复
 * @author 隆宗益
 */

namespace Home\Controller;
use Think\Controller;
use Admin\Controller\CommonController;

class DetailquestionController extends Controller{
	
	/**
	 * 获取问题详情
	 */
	public function index()
	{
		$question_id = (int)I("get.title_id",1);
		//处理页码溢出
		$page_id = (int)I("get.page_id",1);
		$count = M("reply")->where("question_id = $question_id")->count();
		$totalpage = ceil($count/C('PERPAGE_NUM'));
		$page_id = ($page_id<1)? 1:(($totalpage>$page_id)? $page_id:$totalpage);
		
		
		$question = M("question")
				->where("id = $question_id")
				->find();
		
		$reply_list = M("reply")
					  ->where("question_id = $question_id")
					  ->join("LEFT JOIN user ON reply.uid = user.id")
					  ->page("$page_id, C('PERPAGE_NUM')")
					  ->select();
		
		$this->assign('question',$question);
		$this->assign('list',$reply_list);
		
		$this->display();
	}
	/**
	 * 
	 */
	public function reply()
	{
		$question_id = (int)I("get.title_id",1);
		$reply = I("post.reply");
		$uid = '12';//is_login();
		if(isset($question_id)&&isset($reply)&&isset($uid))
		{
			$data = array(
					"question_id"=>$question_id,
					"uid"=>$uid ,
					"time"=> time(),
					"content"=> $reply,			
			);
			$add = M("reply")
					->data($data)
					->add();
			$update = M("question");
			$update -> where("id = $question_id")
					->setInc("reply_count");
			$update ->where("id = $question_id")
					->setField("reply_time",time());
			$this->success("回复成功",U("Detailquestion/index"));
		}
		else
		{
			$this->error("请填写回复内容",U("Detailquestion/index"));
		}
	}
}