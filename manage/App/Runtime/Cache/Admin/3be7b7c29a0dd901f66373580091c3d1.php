<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/manage/App/Admin/Public/Css/public.css" />
	<link rel="stylesheet" href="/manage/App/Admin/Public/kindeditor/themes/default/default.css" />
	<script charset="utf-8" src="/manage/App/Admin/Public/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/manage/App/Admin/Public/kindeditor/lang/zh_CN.js"></script>
	<script>
		var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true,
				});
			});
	</script>
</head>
<body>
	<form action="<?php echo U('Admin/Work/addNoticeHandle');?>" method="post">
		<table class="">
			<tr>
				<th colspan="2">发布通知</th>
			</tr>
			<tr>
				<td align="right">通知标题:</td>
				<td>
					<input type="text" name="title" value="<?php echo ($notice['title']); ?>" />
				</td>
			</tr>
			<tr>
				<td align="right">任务内容:</td>
				<td >
					<textarea id="editor_id" name="content" style="width:700px;height:300px;"><?php echo ($notice['content']); ?></textarea>
				</td>
			</tr>
			<tr id="last">
				<td></td>
				<td colspan="" align="left">	
					<input type="submit" value="发布" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>