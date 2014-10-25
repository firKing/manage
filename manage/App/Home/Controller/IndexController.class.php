<?php
/**
 * 前台首页控制器
 */
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {

	//前台首页
    public function index(){
        
    	//返回用户姓名信息到head上
    	if(isset($_SESSION['username'])) {

			$username = $_SESSION['username'];
			$this->assign('log', $username);
		}

		//获取网校任务
		$count = M('apart_work')
				->where('apart_id = 2')
				->count();
		$Page       = new \Think\Page($count,C('PERPAGE_NUM'));
		$show       = $Page->show();
		$list = M('apart_work')
				->join('LEFT JOIN work ON apart_work.work_id = work.id')
				->where('apart_id = 2')
				->limit($Page->firstRow.','.$Page->listRows)
				->select();

		$this->assign('list',$list);
		$this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
}