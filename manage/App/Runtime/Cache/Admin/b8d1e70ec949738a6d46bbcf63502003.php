<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/manage/App/Admin/Public/Css/public.css" />
</head>
<body>
	<form action="<?php echo U('Admin/Index/informationHandle');?>" method="post">
		<table>
			<tr>
				<th colspan="2">修改信息 ['*'号为必填项]</th>
			</tr>
			<tr>
				<td align="right"><strong>旧</strong>用户名(账号):</td>
				<td>
					<input type="text" name="old_username" />&nbsp;*
				</td>
			</tr>
			<tr>
				<td align="right"><strong>旧</strong>密码:</td>
				<td>
					<input type="password" name="old_password" />&nbsp;*
				</td>
			</tr>
			<!-- <tr>
				<td align="right"><strong>新</strong>用户名(账号):</td>
				<td>
					<input type="text" name="username" />
				</td>
			</tr> -->
			<tr>
				<td align="right"><strong>新</strong>密码:</td>
				<td>
					<input type="password" name="password" />
				</td>
			</tr>
			<tr>
				<td align="right">手机号码:</td>
				<td>
					<input type="text" name="phone" />
				</td>
			</tr>
			<tr>
				<td align="right">邮箱:</td>
				<td>
					<input type="text" name="email" />
				</td>
			</tr>
			<tr>
				<td align="right">所属学院:</td>
				<td>
					<input type="text" name="college" />
				</td>
			</tr>
			<tr id="last">
				<td colspan="2" align="center">
					<input type="submit" value="保存修改" />
				</td>
			</tr>	
		</table>
	</form>
</body>
</html>