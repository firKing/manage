<?php
namespace Admin\Controller;
use Think\Controller;

class MsgManageController extends CommonController {

	public function index(){

		$wish = M('wish');//实例化wish对象
		$count = $wish->count();//查询总数
		$page = new \Think\Page($count, 10);//实例化分页类,传入总数和每页的数量(10)
		$show = $page->show();//分页显示输出
		$this->assign('page', $show);

		$list = $wish->order('time desc')->limit($page->firstRow.','.$page->listRows)->select();
		$this->assign('wish', $list);

  		$this->display();
	}

	public function delete(){

		$id = I('id', '', 'intval');
		$resault = M('wish')->where(array('id' => $id))->delete();
		if($resault){
			$this->success('删除成功');
		}else{
			$this->error('删除失败');
		}
	}
}		
?>