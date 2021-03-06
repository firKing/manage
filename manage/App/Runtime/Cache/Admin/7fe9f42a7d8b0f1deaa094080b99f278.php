<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/manage/App/Admin/Public/Css/public.css" />
	<link rel="stylesheet" href="/manage/App/Admin/Public/kindeditor/themes/default/default.css" />
	<script type="text/javascript" src = '/manage/App/Admin/Public/Js/jquery-1.7.2.min.js'></script>
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
	<style>
		#member{
			display: inline-block;
			width: 100px;
			height: 22px;
			line-height: 22px;
			text-align: center;
			border: 1px solid blue;
			border-radius: 4px;
			margin-left: 10px;
			cursor: pointer;
		}
	</style>
	<script type="text/javascript">
		$(function(){
			$('.add-role').click(function(){
				var obj = $(this).parents('tr').clone();
				obj.find('.add-role').remove();
				$('#last').before(obj); 
			});
		});
	</script>
</head>
<body>
	<form action="<?php echo U('Admin/Work/reviseWorkHandle');?>" name="work" method="post">
		<table class="">
			<tr>
				<th colspan="2">发布任务</th>
			</tr>
			<tr>
				<td align="right">任务标题:</td>
				<td>
					<input type="text" name="title" value="<?php echo ($rework[0]['title']); ?>" />
				</td>
			</tr>
			<tr>
				<td align="right">截止时间:</td>
				<td>
					<input type="text" name="deadline" value="<?php echo ($rework[0]['deadline']); ?>" />
					[ 格式为 <strong>2014-09-01 24:00</strong> ]
				</td>
			</tr>
			<tr>
				<td align="right">任务内容:</td>
				<td >
					<textarea id="editor_id" name="content" style="width:700px;height:300px;"><?php echo ($rework[0]['content']); ?></textarea>
				</td>
			</tr>
			<tr>
				<td align="right">人员分配:</td>
				<td >
					<select name="member_id[]">
						<option value="">请选择人员</option>
						<option value="0">所有人</option>
						<?php if(is_array($member)): foreach($member as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["username"]); ?></option><?php endforeach; endif; ?>
					</select>			
					<span class= 'add-role' id ='member'>再添加一个人</span>
					<span class= 'add-role'>**注意** <strong>需要重新分配人员</strong></span>
				</td>
			</tr>
			<tr>
				<td align="right">人员分配:</td>
				<td >
					<select name="level_id[]">
						<option value="">按级别分配</option>
						<?php if(is_array($level)): foreach($level as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
					<span class= 'add-role' id ='member'>添加一个级别</span>
				</td>
			</tr>
			<tr id="last">
			<td></td>
				<td colspan="" align="left">
					<input type="hidden" value="<?php echo ($rework[0]['id']); ?>" name="work_id" />
					<input type="submit" value="发布" />
				</td>
			</tr>
		</table>
	</form>
</body>
</html>