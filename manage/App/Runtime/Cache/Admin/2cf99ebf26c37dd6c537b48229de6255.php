<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/REM/manage/App/Admin/Public/Css/public.css" />
	<style type="text/css">
		#usersearch{
			width: 520px;
			height: 28px;
			margin-left: 109px;
			float: left;
		}
		#subsearch{
			width: 100px;
			height: 35px;
			margin-right: 111px;
			float: right;
		}
	</style>
</head>
<body>
	<table class="table">
		<tr>
			<form action="<?php echo U('Admin/Rbac/index');?>" method="post">
				<th >姓名搜索</th>
				<th colspan="8">
					<input type="text" id="usersearch" name="search" />
					<input type="submit" value="搜索" id="subsearch" />
				</th>
			</form>
		</tr>
		<tr>
			<th>ID</th>
			<th>用户姓名</th>
			<th>上次登录时间</th>
			<th>上次登陆IP</th>
			<th>锁定状态</th>
			<th>所属组别</th>
			<th>所属部门</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($user)): foreach($user as $key=>$v): ?><tr>
				<td><?php echo ($v["id"]); ?></td>
				<td><?php echo ($v["username"]); ?></td>
				<td><?php echo (date('y-m-d H:i', $v["logintime"])); ?></td>
				<td><?php echo ($v["loginip"]); ?></td>
				<td><?php if(!$v["user_status"]): ?>锁定<?php endif; ?></td>
				<td>
					<?php if($v["username"] == C("RBAC_SUPERADMIN")): ?>炒鸡管理员
					<?php else: ?>
						<ul>
							<?php if(is_array($v['role'])): foreach($v['role'] as $key=>$value): ?><li><?php echo ($value["name"]); ?>(<?php echo ($value["remark"]); ?>)</li><?php endforeach; endif; ?>
						</ul><?php endif; ?>
				</td>
				<td>
					<ul>
						<?php if(is_array($v['apartment'])): foreach($v['apartment'] as $key=>$ap): ?><li><?php echo ($ap["name"]); ?></li><?php endforeach; endif; ?>
					</ul>
				</td>
				<td>
					[<a href="">锁定</a>]&nbsp;
					[<a href="<?php echo U('Admin/Rbac/deleteuser', array('uid' => $v['id']));?>">删除</a>]
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
	<ul class="flip"><?php echo ($page); ?></ul>
</body>
</html>