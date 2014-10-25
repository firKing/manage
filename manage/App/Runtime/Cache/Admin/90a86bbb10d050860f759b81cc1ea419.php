<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/REM/manage/App/Admin/Public/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr>
			<th>ID</th>
			<th>部门名称</th>
			<th>开启状态</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($dept)): foreach($dept as $key=>$v): ?><tr>
				<td><?php echo ($v["dept_id"]); ?></td>
				<td><?php echo ($v["dept_name"]); ?></td>
				<td>
					<?php if($v["dept_status"]): ?>开启<?php else: ?>关闭<?php endif; ?>
				</td>
				<td>
					[<a href="<?php echo U('Admin/Rbac/deleteDept', array('dept_id' => $v['dept_id']));?>">删除</a>]
				</td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>