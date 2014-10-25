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
			<th>标题</th>
			<th>提问者</th>
			<th>提问时间</th>
			<th>回复数</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resource): $mod = ($i % 2 );++$i;?><tr class="inform_even">
	            <td><?php echo ($resource["title"]); ?></td>
	            <td class="doc"><?php echo ($resource["username"]); ?></td>
	            <td><?php echo date("m-d H:i",$resource['time']);?></td>
	            <td><?php echo ($resource["reply_count"]); ?></td>
	            <td>[<a href="<?php echo U('Admin/Other/questionHandle', array('queId' => $resource[question_id]));?>">删除</a>]</td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<?php echo ($page); ?>
</body>
</html>