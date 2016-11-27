<?php
namespace Home\Model;
use Think\Model\RelationModel;

class AdminModel extends RelationModel {
	
	 protected $_link = array(

	 	'Auth_group' => array(
		 	'mapping_type'  => self::MANY_TO_MANY,
		 	'class_name'    => 'Auth_group',
		 	'foreign_key'   => 'uid',			//admin表对应的关联表字段
		 	'mapping_name'  => 'groups',
		 	'mapping_fields' => 'title',		//关联查询的字段title
		 	'relation_foreign_key'  =>  'group_id',
		 	'relation_table'    =>  'Auth_group_access', //此处应显式定义中间表名称，且不能使用C函数读取表前缀
		 	),
	 	);












}