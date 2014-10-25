<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
	<title>Document</title>
	<link rel="stylesheet" href="/oldmanage/App/Admin/Public/Css/public.css" />
</head>
<body>
	<table class="table">
		<tr>
			<th>文件名</th>
			<th>上传者</th>
			<th>上传时间</th>
			<th>下载</th>
		</tr>
		<?php if(is_array($work_up)): foreach($work_up as $key=>$v): ?><tr>
				<td><?php echo ($v["filename"]); ?></td>
				<td><?php echo ($v["username"]); ?></td>
				<td><?php echo (date( "m-d H:i", $v["time"])); ?></td>
				<?php $vid = $v['work_up_id']; ?>
				<td><!-- <a href="/oldmanage/Uploads/work/<?php echo ($v["savepath"]); ?>">下载</a> &url=<?php echo ($savepath); ?>-->
	<a href="<?php echo U('Admin/Work/downWork',array('vid'=>$vid));?>">下载</a></td>
			</tr><?php endforeach; endif; ?>
	</table>
</body>
</html>