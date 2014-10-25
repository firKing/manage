<?php
return array(
	//设置访问列表
	'MODULE_ALLOW_LIST' => array('Home','Admin'),
	//'DEFAULT_MODULE' => 'Home',

    //显示信息(基本/加载文件/流程/SQL/调试)右下角
    //'SHOW_PAGE_TRACE' => true,

	//数据库配置
	'DB_TYPE'               =>  'mysql',     	// 数据库类型
    'DB_HOST'               =>  '127.0.0.1', 	// 服务器地址
    'DB_NAME'               =>  'manage',       // 数据库名
    'DB_USER'               =>  'root',      	// 用户名
    'DB_PWD'                =>  '19931024',    	// 密码
    'DB_PORT'               =>  '3306',        	// 端口
    'DB_PREFIX'   			=>	'',

    //是否开启session
    'SESSION_AUTO_START' => true,

    //权限验证
    'RBAC_SUPERADMIN' => 'admin',       //超级管理员账号
    'ADMIN_AUTH_KEY' => 'superadmin',   //超级管理员识别
    'USER_AUTH_ON' => true,             //是否开启验证
    'USER_AUTH_TYPE' => 1,              //验证类型(1:登录验证 2:实时验证)

    'RBAC_ROLE_TABLE' => 'role',        //角色表名称
    'RBAC_USER_TABLE' => 'role_user',   //角色表和用户表的中间表
    'RBAC_ACCESS_TABLE' => 'access',    //权限表名称
    'RBAC_NODE_TABLE' => 'node',        //节点表名称
    
);