<?php
/**
 * 问答系统模块
 * 问答首页
 * @param Array $list 问题列表
 * @author 隆宗益
 */

namespace Home\Controller;
use Think\Controller;
use Admin\Controller\CommonController;


class QuestionController extends Controller{
	
		
		/**
		 * 分页并获取最新
		 */
		public function index(){
		
			//处理页码溢出
			$page_id = (int)I("get.page_id",1);
			$count = M("question")->count();
			$totalpage = ceil($count/C('PERPAGE_NUM'));
			$page_id = ($page_id<1)? 1:(($totalpage>$page_id)? $page_id:$totalpage);
			
			$list = M("question")
					->order('reply_time DESC')
					->join("LEFT JOIN user ON question.uid = user.id")
					->page("$page_id, C('PERPAGE_NUM')")
					->select();
			$this->assign('list',$list);
			$this->display();
			
		}
		/**
		 * 提交问题
		 */
		public function submitquestion()
		{
			$title = I('post.title');
			$content = I('post.content');
			$uid =session('uid'); //is_login();
			$data = array(
					'title'=> $title,
					'uid'=> $uid,
					'time'=> time(),
					'content'=> $content,
					'reply_time'=>time(),
					'reply_count'=>'0',
			);
		
		if(M('question')->data($data)->add()){
			$this->success("提问成功!");
		}else
			$this->error("啊哦,提问失败了T.T再试试吧~");
			
		}
		
		
		
		
		
		
}

?>