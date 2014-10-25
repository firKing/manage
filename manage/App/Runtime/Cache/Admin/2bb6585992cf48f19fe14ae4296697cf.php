<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/manage/App/Admin/Public/Css/public.css" />
	<link rel="stylesheet" href="/manage/App/Admin/Public/kindeditor/themes/default/default.css" />
	<link type="text/css" href="/manage/App/Admin/Public/Css/jquery-ui-1.8.17.custom.css" rel="stylesheet" />
    <link type="text/css" href="/manage/App/Admin/Public/Css/jquery-ui-timepicker-addon.css" rel="stylesheet" />
    <script type="text/javascript" src="/manage/App/Admin/Public/Js/jquery-1.7.1.min.js"></script>
	<script type="text/javascript" src="/manage/App/Admin/Public/Js/jquery-ui-1.8.17.custom.min.js"></script>
	<script type="text/javascript" src="/manage/App/Admin/Public/Js/jquery-ui-timepicker-addon.js"></script>
    <script type="text/javascript" src="/manage/App/Admin/Public/Js/jquery-ui-timepicker-zh-CN.js"></script>
	<!-- <script type="text/javascript" src = '/manage/App/Admin/Public/Js/jquery-1.7.2.min.js'></script> -->
	<script charset="utf-8" src="/manage/App/Admin/Public/kindeditor/kindeditor.js"></script>
	<script charset="utf-8" src="/manage/App/Admin/Public/kindeditor/lang/zh_CN.js"></script>
	<style>
		.add-role{
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
	<script>
		var editor;
			KindEditor.ready(function(K) {
				editor = K.create('textarea[name="content"]', {
					allowFileManager : true
				});
			});
	</script>
	<script type="text/javascript">
		$(function(){
			$('.add-role').click(function(){
				var obj = $(this).parents('tr').clone();
				obj.find('.add-role').remove();
				$('#last').before(obj); 
			});
		});
	</script>
	<script type="text/javascript">
	    $(function () {
	        $(".ui_timepicker").datetimepicker({
	            showSecond: true,
	            timeFormat: 'hh:mm:ss',
	            stepHour: 1,
	            stepMinute: 1,
	            stepSecond: 1
	        });
	    });
    </script>
</head>
<body>
	<form action="<?php echo U('Admin/Work/addWorkHandle');?>" name="work" method="post">
		<table >
			<tr>
				<th colspan="2">发布任务</th>
			</tr>
			<tr>
				<td align="right">任务标题:</td>
				<td>
					<input type="text" name="title" />
				</td>
			</tr>
			<tr>
				<td align="right">截止时间:</td>
				<td>
					<p><input type="text" name="deadline" class="ui_timepicker" /></p>
				</td>
			</tr>
			<tr>
				<td align="right">任务内容:</td>
				<td >
					<textarea id="editor_id" name="content" style="width:700px;height:300px;"></textarea>
				</td>
			</tr>
			<tr>
				<td align="right">人员分配:</td>
				<td >
					<select name="member_id[]">
						<option value="">按个人分配</option>
						<?php if(is_array($member)): foreach($member as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["username"]); ?></option><?php endforeach; endif; ?>
					</select>
					<span class= 'add-role'>添加一个人</span>
				</td>
			</tr>
			<tr>
				<td align="right">人员分配:</td>
				<td >
					<select name="level_id[]">
						<option value="">按级别分配</option>
						<?php if(is_array($level)): foreach($level as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?></option><?php endforeach; endif; ?>
					</select>
					<span class= 'add-role'>添加一个级别</span>
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