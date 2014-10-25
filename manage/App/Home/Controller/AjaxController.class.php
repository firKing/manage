<?php
namespace Home\Controller;
use Think\Controller;
/*
*前台公用控制器
*/
class AjaxController extends CommonController {

	public function index(){
		//if (!IS_AJAX) $this->error('页面不存在');
		$info = M('information')->order('id desc')->limit('13')->select();
		$this->ajaxReturn($data, 'json');
	}
}
?>
