<?php
namespace Admin\Controller;
use Think\Controller;
/*
*后台公用控制器
*/
class OtherController extends CommonController {

	public function resource(){
		$User = M('resource'); // 实例化User对象
		$count      = $User->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,13);// 实例化分页类 传入总记录数和每页显示的记录数(13)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->order('id desc')->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('Resource_list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		$this->display(); // 输出模板
	}

	public function resourceHandle(){
		$reId = I('reId');
		$re = M('resource')->where(array('id' => $reId))->delete();
		if ($re) {
			$this->success("删除成功!", U('Admin/Other/resource'));
		}else{
			$this->error('删除失败');
		}
	}

	public function question(){
		$User = M('question'); // 实例化User对象
		$count      = $User->count();// 查询满足要求的总记录数
		$Page       = new \Think\Page($count,13);// 实例化分页类 传入总记录数和每页显示的记录数(13)
		$show       = $Page->show();// 分页显示输出
		// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
		$list = $User->order('question_id desc')
					 ->join('LEFT JOIN user ON uid = user.id')
					 ->limit($Page->firstRow.','.$Page->listRows)->select();
		$this->assign('list',$list);// 赋值数据集
		$this->assign('page',$show);// 赋值分页输出
		
		$this->display(); // 输出模板
	}

	public function questionHandle(){
		$queId = I('queId');
		$re1 = M('question')->where(array('question_id' => $queId))->delete();
		$re2 = M('reply')->where(array('question_id' => $queId))->delete();
		if ($re1 || $re2) {
			$this->success("删除成功!", U('Admin/Other/question'));
		}else{
			$this->error("删除失败");
		}
	}
}
?>