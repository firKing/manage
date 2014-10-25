<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/manage/App/Admin/Public/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr>
			<th>任务标题</th>
			<th>截止时间</th>
			<th>完成进度</th>
			<th>提交情况</th>
			<th>修改任务</th>
		</tr>
		<?php if(is_array($work)): foreach($work as $key=>$v): ?><tr>
				<td><?php echo ($v["title"]); ?></td>
				<td><?php echo ($v["deadline"]); ?></td>
				<td></td>
				<td><strong><a href="<?php echo U('Admin/Work/subedWork', array('work_id' => $v['id']));?>">查看提交情况</a></strong></td>
				<td><strong><a href="<?php echo U('Admin/Work/reviseWork', array('work_id' => $v['id']));?>">点击修改</a></strong></td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>