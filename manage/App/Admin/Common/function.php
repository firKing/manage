<?php

/**
 * 递归重组节点信息为多维数组
 *$node 要处理的节点数组
 *$pid  父级id
 */
function node_merge($node, $access= null, $pid = 0){
	
	$arr = array();
	foreach ($node as $v) {
		if (is_array($access)) {
			$v['access'] = in_array($v['id'], $access) ? 1 : 0;
		}
		if ($v['pid'] == $pid) {
			$v['child'] = node_merge($node, $access, $v['id']);
			$arr[] = $v;
		}
	}
	return $arr;
}

function downlode($url){
$file_name = $url;
$mime = 'application/force-download';
header('Pragma: public'); // required
header('Expires: 0'); // no cache
header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
header('Cache-Control: private',false);
header('Content-Type: '.$mime);
header('Content-Disposition: attachment; filename="'.basename($file_name).'"');
header('Content-Transfer-Encoding: binary');
header('Connection: close');
readfile($file_name); // push it out
exit();
}
?>