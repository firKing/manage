<?php
namespace Admin\Model;
use Think\Model\RelationModel;
/**
* 部门与任务关联模型
*
*	**发送多条SQL语句,视图模型用join只发送一条SQL语句**
*/
class WorkRelationModel extends RelationModel{
	
	//定义主表名称
	Protected $tableName = 'work';

/*		
*	**HAS_ONE 一对一关系**
*	**HAS_MANY 一对多关系**
*	**MANY_TO_MANY 多对多关系**
*/
	//定义关联关系
	Protected $_link = array(
		'apartment' => array(
			'mapping_type' => self::MANY_TO_MANY, 
			'foreign_key' => 'work_id',				//主表在中间表中的字段名称
			'relation_foreign_key' => 'apart_id',	//副表在中间表中的字段名称
			'relation_table' => 'apart_work',		//中间表名称(如果有前缀要记得加)
			'mapping_fields' => 'id, name'
			),
		'user' => array(
			'mapping_type' => self::MANY_TO_MANY, 
			'foreign_key' => 'work_id',				//主表在中间表中的字段名称
			'relation_foreign_key' => 'user_id',	//副表在中间表中的字段名称
			'relation_table' => 'work_user',		//中间表名称(如果有前缀要记得加)
			'mapping_fields' => 'id, username'
			),
		'level' => array(
			'mapping_type' => self::MANY_TO_MANY, 
			'foreign_key' => 'work_id',				//主表在中间表中的字段名称
			'relation_foreign_key' => 'level_id',	//副表在中间表中的字段名称
			'relation_table' => 'work_level',		//中间表名称(如果有前缀要记得加)
			'mapping_fields' => 'id, name'
			)
		);
	
}
?>