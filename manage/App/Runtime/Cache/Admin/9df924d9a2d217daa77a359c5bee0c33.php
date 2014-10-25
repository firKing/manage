<?php if (!defined('THINK_PATH')) exit();?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<script type="text/javascript" src="/manage/App/Admin/Public/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="/manage/App/Admin/Public/Js/index.js"></script>
<link rel="stylesheet" href="/manage/App/Admin/Public/Css/public.css" />
<link rel="stylesheet" href="/manage/App/Admin/Public/Css/index.css" />
<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
<base target="iframe"/>
<head>
</head>
<body>
	<div id="top">
		<div class="menu">
			<a href="<?php echo U('Admin/Index/conf');?>">后台首页</a>
			<a href="<?php echo U('Home/Index/index');?>" target="_blank">前台首页</a>
			<a href="<?php echo U('Home/Apart/index');?>" target="_blank">部门首页</a>
			<!-- <a href="#">选择按钮</a>
			<a href="#">选择按钮</a>
			<a href="#">选择按钮</a> -->
		</div>
		<div class="exit">
			<a href="<?php echo U('Admin/Index/logout');;?>" target="_self">退出</a>
			<!-- <a href="<?php echo U('Admin/Index/information');?>" target="_blank">修改信息</a> -->
		</div>
	</div>
	<div id="left">
		<dl>
			<dt>任务管理</dt>
			<!-- <dd><a href="<?php echo U('Admin/MsgManage/index');?>">查看所有</a></dd> -->
			<dd><a href="<?php echo U('Admin/Work/index');?>">任务列表</a></dd>
			<dd><a href="<?php echo U('Admin/Work/addNotice');?>">发布通知</a></dd>
			<dd><a href="<?php echo U('Admin/Work/addWork');?>">发布任务</a></dd>
		</dl>
		<dl>
			<dt>其他功能</dt>
			<dd><a href="<?php echo U('Admin/Other/resource');?>">资源列表</a></dd>
			<dd><a href="<?php echo U('Admin/Other/question');?>">问答列表</a></dd>
			<!-- <dd><a href="#">功能标题</a></dd>
			<dd><a href="#">功能标题</a></dd>
			<dd><a href="#">功能标题</a></dd>
			<dd><a href="#">功能标题</a></dd> -->
		</dl>
		<dl>
			<dt>权限管理</dt>
			<dd><a href="<?php echo U('Admin/Rbac/index');?>">用户列表</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/role');?>">角色列表</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/dept');?>">部门列表</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/node');?>">节点列表</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/addUser');?>">添加用户</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/addRole');?>">添加角色</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/addDept');?>">添加部门</a></dd>
			<dd><a href="<?php echo U('Admin/Rbac/addNode');?>">添加节点</a></dd>
			
		</dl>
	</div>
	<div id="right">
		<iframe name="iframe" src="<?php echo U('Admin/Index/conf');?>"></iframe>
	</div>
</body>
</html>