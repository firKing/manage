<?php
namespace Home\Model;
use Think\Model\RelationModel;
/**
* 部门与任务关联模型
*
*	**发送多条SQL语句,视图模型用join只发送一条SQL语句**
*/
class ApartRelationModel extends RelationModel{
	
	//定义主表名称
	Protected $tableName = 'apartment';

/*		
*	**HAS_ONE 一对一关系**
*	**HAS_MANY 一对多关系**
*	**MANY_TO_MANY 多对多关系**
*/
	//定义关联关系
	Protected $_link = array(
		'work' => array(
			'mapping_type' => self::MANY_TO_MANY, 
			'foreign_key' => 'apart_id',				//主表在中间表中的字段名称
			'relation_foreign_key' => 'work_id',	//副表在中间表中的字段名称
			'relation_table' => 'apart_work',		//中间表名称(如果有前缀要记得加)
			'mapping_fields' => 'id, title, content, deadline'
			),
		'user' => array(
			'mapping_type' => self::MANY_TO_MANY, 
			'foreign_key' => 'apart_id',				//主表在中间表中的字段名称
			'relation_foreign_key' => 'user_id',	//副表在中间表中的字段名称
			'relation_table' => 'apart_user',		//中间表名称(如果有前缀要记得加)
			'mapping_fields' => 'id, username'
			),
		'notice' => array(
			'mapping_type' => self::MANY_TO_MANY, 
			'foreign_key' => 'apart_id',				//主表在中间表中的字段名称
			'relation_foreign_key' => 'notice_id',	//副表在中间表中的字段名称
			'relation_table' => 'apart_notice',		//中间表名称(如果有前缀要记得加)
			'mapping_fields' => 'id, title, content, createtime'
			),
		);
	
}
?>