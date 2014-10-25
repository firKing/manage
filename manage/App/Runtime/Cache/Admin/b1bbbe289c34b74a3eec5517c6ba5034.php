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
			<th>文件名</th>
			<th>格式</th>
			<th>大小</th>
			<th>上传时间</th>
			<th>操作</th>
		</tr>
		<?php if(is_array($Resource_list)): $i = 0; $__LIST__ = $Resource_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$resource): $mod = ($i % 2 );++$i;?><tr class="inform_even">
	            <td><?php echo ($resource["filename"]); ?></td>
	            <td class="doc"><?php echo ($resource["type"]); ?></td>
	            <td><?php echo sprintf("%.2f",$resource['size']/1024/1024); ?>Mb</td>
	            <td><?php echo date("m-d H:i",$resource['time']);?></td>
	            <td>[<a href="<?php echo U('Admin/Other/resourceHandle', array('reId' => $resource[id]));?>">删除</a>]</td>
	        </tr><?php endforeach; endif; else: echo "" ;endif; ?>
	</table>
	<?php echo ($page); ?>
</body>
</html>