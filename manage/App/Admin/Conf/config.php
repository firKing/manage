<?php
return array(

	//权限验证
	'USER_AUTH_KEY' => 'uid',           //用户认证识别号
	'NOT_AUTH_MODULE' => '',       //无需认证的控制器
    'NOT_AUTH_ACTION' => 'addUserHandle,addRoleHandle,addNodeHandle,setAccess,addWorkHandle,reviseWorkHandle,logout,pwdHandle,addNoticeHandle,conf,infHandle,subedWork,downWork',  //无需认证的工作方法
	//Public文件位置
	'TMPL_PARSE_STRING' => array(
		'__PUBLIC__' => __ROOT__ . '/' . APP_NAME . '/Admin/Public',
		),

	//伪静态后缀
	'URL_HTML_SUFFIX' => '',
);