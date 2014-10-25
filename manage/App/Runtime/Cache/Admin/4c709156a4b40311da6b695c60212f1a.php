<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<!--
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/oldmanage/App/Admin/Public/Css/public.css" />
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
	<script type="text/javascript" src = '/oldmanage/App/Admin/Public/Js/jquery-1.7.2.min.js'></script>
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
	<form action="<?php echo U('Admin/Rbac/addUserHandle');?>" method="post">
		<table>
			<tr>
				<th colspan="4">添加用户</th>
			</tr>
			<tr>
				<td align="right" width="30%" >用户账号:</td>
				<td>
					<input type="text" name="username" />
				</td>
			</tr>
			<tr>
				<td align="right">用户密码:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td align="right">所属部门:</td>
				<td>
					<select name="dept_id[][dept]">
						<option value="">请选择部门</option>
						<?php if(is_array($dept)): foreach($dept as $key=>$v): ?><option value="<?php echo ($v['dept_id']); ?>"><?php echo ($v["dept_name"]); ?></option><?php endforeach; endif; ?>
					</select>
					<select name="dept_id[][role]">
						<option value="">请选择职务</option>
						<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
					</select>
					<span class= 'add-role'>添加一个部门</span>
				</td>
			</tr>
			<tr id="last">
				<td colspan="2" align="center">
					<input type="submit" value="保存添加" />
				</td>
			</tr>
		</table>
	</form>
</body>
-->
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/oldmanage/App/Admin/Public/Css/public.css" />
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
	<script type="text/javascript" src = '/oldmanage/App/Admin/Public/Js/jquery-1.7.2.min.js'></script>

</head>
<body>
	<form action="<?php echo U('Admin/Rbac/addUserHandle');?>" method="post">
		<table>
			<tr>
				<th colspan="4">添加用户</th>
			</tr>
			<tr>
				<td align="right" width="30%" >用户账号:</td>
				<td>
					<input type="text" name="username" />
				</td>
			</tr>
			<tr>
				<td align="right">用户密码:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td align="right">所属部门:</td>
				<td>
					<select name="info[0][dept]">
						<option value="">请选择部门</option>
						<?php if(is_array($dept)): foreach($dept as $key=>$v): ?><option value="<?php echo ($v['dept_id']); ?>"><?php echo ($v["dept_name"]); ?></option><?php endforeach; endif; ?>
					</select>
					<select name="info[0][role]">
						<option value="">请选择职务</option>
						<?php if(is_array($role)): foreach($role as $key=>$v): ?><option value="<?php echo ($v['id']); ?>"><?php echo ($v["name"]); ?>(<?php echo ($v["remark"]); ?>)</option><?php endforeach; endif; ?>
					</select>
					<span class= 'add-role'>添加一个部门</span>
				</td>
			</tr>
			<tr id="last">
				<td colspan="2" align="center">
					<input type="submit" value="保存添加" />
				</td>
			</tr>
		</table>
	</form>
</body>
<script src="jquery.js"></script>
	<script type="text/javascript">
		$(function(){
			var j = 1;
			$('.add-role').click(function(){
				var obj = $(this).parents('tr').clone();
				obj.find('.add-role').remove();
				$('#last').before(obj);
				var a = $(this).parents('tr');
				console.log(a);
				for(var i = 0; i <a.length;i++,j++){
			    	var b = $(a[i]).find('select');
			    	console.log(b);
			    	b[0].setAttribute('name','info['+j+'][dept]');
			    	b[1].setAttribute('name','info['+j+'][role]');
		    	};
			});
		});
		
	</script>
</html>