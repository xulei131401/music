<?php
return array(
	//'配置项'=>'配置值'
	'T_URL' => __ROOT__.'/Public/Home',
	//Auth方式权限验证配置
	'AUTH_CONFIG'=>array(
	'AUTH_ON'           => true,                    // 认证开关
    'AUTH_TYPE'         => 1,                       // 认证方式，1为实时认证；2为登录认证。
    'AUTH_GROUP'        => 'auth_group',            // 用户组数据表名
    'AUTH_GROUP_ACCESS' => 'auth_group_access',     // 用户-用户组关系表
    'AUTH_RULE'         => 'auth_rule',             // 权限规则表
    'AUTH_USER'         => 'admin'                 // 用户信息表
    ),
);